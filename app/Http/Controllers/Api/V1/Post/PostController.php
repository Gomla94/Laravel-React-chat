<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\DataProviders\PostDataProvider;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponser;

    public function index(Request $request,PostDataProvider $provider):JsonResponse
    {
        return $this->successResponse([
            $provider->getBuilder()->paginate(2)->withQueryString()
        ]);
    }

    public function store(Request $request):JsonResponse
    {
        $post = Post::create(array_merge($request->all(),['user_id' => $request->user()->id]));
        return $this->successResponse([
            'post' => PostResource::make($post)->hide(['created_at','updated_at'])
        ]);
    }
}

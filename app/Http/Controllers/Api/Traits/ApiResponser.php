<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{

    /**
     * Return a success JSON response.
     *
     * @param array $response
     * @param int|null $status
     * @return JsonResponse
     */
    protected function successResponse($response = [], $status = 200):JsonResponse
	{
		return response()->json(array_merge($response,['success' => true]), $status);
	}


    /**
     * Return an error JSON response.
     *
     * @param string $errorMessage
     * @param int $status
     * @return JsonResponse
     */
	protected function errorResponse($errorMessage = 'labels.api.notFound', $status = 404):JsonResponse
	{
		return response()->json(
            __($errorMessage),
            $status
        );
	}
}
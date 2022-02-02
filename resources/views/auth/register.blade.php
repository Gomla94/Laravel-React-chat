@extends('layouts.auth')
@section('title') @lang('translations.sign_up') @endsection
@section('content')
    <div class="main-page-button-wrapper">
        <a href="{{ route('welcome') }}" class="containers">
            <img class="box-logo"
                 src="{{asset('images/dark-logo-new.jpeg')}}"
            />
            <div class="box-shadow"></div>
        </a>
    </div>
    <div class="r-god-container">
        <div class="r-super-container1">
            <h2 class="title-h2">@lang('translations.welcm')</h2>

            <div class="container-p">
                <p class="r-subtitle-p">
                    @lang('translations.inf')
                </p>

                <div class="div-button1">
                    <a class="custom-btn btn-7 mb-5" style="text-decoration: none"
                       href="{{ route('login') }}"><span>@lang('translations.login')</span></a>
                </div>
            </div>
        </div>

        <br/>
        <div class="r-super-container2">
            <div class="title-container mt-3">
                <h1>@lang('translations.acc_create')</h1>
            </div>

            <div class="form mt-5">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-div">
                        <label for="name"></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="@lang('translations.name')"/>
                    </div>
                    @error('name')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div">
                        <label for="email"></label>
                        <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="@lang('translations.e_mail')"/>
                    </div>
                    @error('email')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div password-group">
                        <label for="password"></label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="@lang('translations.password')"
                        />
                        {{-- <i class="fas fa-eye show-password-icon"></i> --}}
                    </div>
                    @error('password')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div">
                        <input
                            id="phone_number"
                            type="text"
                            name="phone_number"
                            value="{{ old('phone_number') }}"
                            placeholder="@lang('translations.phone_numb')"
                        />
                    </div>
                    @error('phone_number')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="type-group">
                        <label for="type">@lang('translations.type')</label>
                        <div class="type-wrapper">
                            <input
                                type="radio"
                                class="user-type"
                                name="type"
                                id="benefactor"
                                value="benefactor"
                            />
                            <label for="benefactor" style="cursor: pointer">@lang('translations.benefac')</label>
                        </div>
                        <div class="type-wrapper">
                            <input
                                type="radio"
                                class="user-type"
                                name="type"
                                id="user"
                                value="user"
                            />
                            <label for="user" style="cursor: pointer">@lang('translations.user')</label>
                        </div>
                    </div>
                    @error('type')
                    <div class="input-error mt-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div interests-group interesting-types-group-div">
                        <label
                            for="types-list"
                            class="input-label interesting-types-label"
                        >@lang('translations.interest_area')</label>
                    </div>
                    @error('interesting_type')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <div class="input-div additionals-group">
                        <label for="child-types" class="input-label child-types-label"
                        >@lang("translations.add_types")</label>

                        <select
                            name="additional_type"
                            class="child-types-select"
                            id="child-types-list"
                        >
                            <option value="" disabled selected>@lang('translations.select_type')</option>
                            <option value="individual">@lang('translations.individ')</option>
                            <option value="organisation">@lang('translations.org')</option>
                        </select>
                    </div>
                    @error('additional_type')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <div class="input-div organisation-div">
                        <label for="organisation"
                               class="input-label organisation-label">@lang('translations.org_desc')</label>
                        <textarea name="organisation_description" class="organisation-input" id="organisation" cols="30"
                                  rows="10"></textarea>
                        @error('organisation_description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="button">
                        <button class="custom-btn btn-7 mb-5"><span>@lang('translations.sign_up')</span></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
  </div>
@push('js')
<script src="{{ asset('js/authentication.js?version=1') }}"></script>
@endpush
@endsection

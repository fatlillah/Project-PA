@extends('layouts.apps')

@section('header-content')
<div class="header-left">
    <div class="dashboard_bar">
        Profile
    </div>
</div>
@endsection

		@section('content')
        <!-- row -->
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-sm-12">
                <form method="post" action="{{ route('profile.update') }}" id="profile_setup_frm" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                <div class="card overflow-hidden">
                    <div class="text-center p-5 overlay-box" style="background-image: url('assets/images/big/img5.jpg');">
                        <label for="profile_image">
                            @php($profile_image = auth()->user()->profile_image)
                            <img class="rounded-circle mt-5" height="120" width="120" src="@if($profile_image == null) {{ asset("storage/profile_images/avatar.png") }}  @else {{ asset("storage/$profile_image") }} @endif" alt="" id="image_preview_container">
                            <h3 class="mt-3 mb-0 text-white">{{ auth()->user()->name }}</h3>
                        </label>
                        <input type="file" name="profile_image" id="profile_image" style="display: none;">
                    </div>
                    
                    <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}"  autofocus autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            Your email address is unverified.
                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Click here to re-send the verification email.
                                            </button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                A new verification link has been sent to your email address.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                    </div>
                    <div class="card-footer mt-0">								
                        <button class="btn btn-primary btn-lg btn-block" id="btn" type="submit">Save</button>		
                    </div>
                </div>
            </form>
            </div>
            <div class="col-xl-8 col-lg-12 col-xxl-8 col-sm-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="settings-form">
                                    <h4 class="text-primary">Perbarui Password</h4>
                                    <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label class="form-label" for="current_password">Password Lama</label>
                                            <div class="input-group" id="show_hide_current_password">
                                                <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='fas fa-eye'></i></a>
                                            </div>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password Baru</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='fas fa-eye'></i></a>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                            <div class="input-group" id="show_hide_password_confirmation">
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="new-password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='fas fa-eye'></i></a>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary" style="float: right" type="submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        @endsection		
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

        <script src="{{ url('assets/js/profile-update.js') }}"></script>
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
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="{{ url("assets/images/profile/profile.png") }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ auth()->user()->name }}</h4>
                                    <p>Nama</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ auth()->user()->email }}</h4>
                                    <p>Email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="settings-form">
                                    <h4 class="text-primary">Informasi Profil</h4>
                                    <form method="post" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('patch')
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama</label>
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="email">
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
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-12">
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
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
        @endsection		
				
      
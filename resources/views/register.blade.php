@extends('layouts.master')

@section('title', 'register')

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf

            @error('terms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" value="{{ old('name') }}" name="name"
                    placeholder="Username">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" value=" {{ old('email') }} " name="email"
                    placeholder="Email">
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="tel" value="{{ old('phone') }}" name="phone"
                    placeholder="Phone">
                @error('phone')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                <label for="Gender">Gender</label>
                <select name="gender" id="Gender" class="form-control">
                    <option value="none">Choose Gender</option>
                    <option value="male" selected>Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" value="{{ old('address') }}" name="address"
                    placeholder="Address">
                @error('address')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                @error('password')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
    </div>
@endsection

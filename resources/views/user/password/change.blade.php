@extends('user.layouts.master')

@section('title', 'User Change Password')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- MAIN CONTENT-->
                    <div class="main-content">
                        <div class="section__content section__content--p30">
                            <div class="container-fluid">
                                <div class="col-lg-6 offset-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Change Password</h3>
                                            </div>
                                            <hr>
                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation me-2 text-success"></i><strong>Password
                                                        Change Successful
                                                        ...</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif

                                            @if (session('ErrorMessage'))
                                                <div class="alert alert-danger alert-dismissible fade show text-center"
                                                    role="alert">
                                                    <strong>{{ session('ErrorMessage') }}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif

                                            <form action="{{ route('password#change') }}" method="post"
                                                novalidate="novalidate">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="oldPassword" class="control-label mb-1">Old Passowrd</label>
                                                    <input id="oldPassword" name="oldPassword" type="password"
                                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                                        @session('ErrorMessage') @session aria-required="true" aria-invalid="false"
                                                        @session('success') @session placeholder="Enter Old Password">

                                                    @error('oldPassword')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    @if (session('ErrorMessage'))
                                                        <small class="text-danger">{{ session('ErrorMessage') }}</small>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="newPassword" class="control-label mb-1">New Passowrd</label>
                                                    <input id="newPassword" name="newPassword" type="password"
                                                        class="form-control @error('newPassword') is-invalid @enderror"
                                                        @session('ErrorMessage') @session aria-required="true" aria-invalid="false"
                                                        placeholder="Enter New Password">

                                                    @error('newPassword')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label for="confirmPassword" class="control-label mb-1">New
                                                        Passowrd</label>
                                                    <input id="confirmPassword" name="confirmPassword" type="password"
                                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                                        @session('ErrorMessage') @session aria-required="true" aria-invalid="false"
                                                        placeholder="Enter New Password">

                                                    @error('confirmPassword')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    @if (session('ErrorMessage'))
                                                        <small class="text-danger">{{ session('ErrorMessage') }}</small>
                                                    @endif
                                                </div>
                                                <div>
                                                    <button id="payment-button" type="submit"
                                                        class="btn btn-lg btn-primary btn-block text-uppercase">
                                                        <span id="payment-button-amount">Confirm</span>
                                                        <i class="fa-solid fa-circle-right"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MAIN CONTENT-->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

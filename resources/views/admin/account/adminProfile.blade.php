@extends('admin.layouts.master')

@section('title', 'Admin Profile')

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
                                <div class="col-lg-8 offset-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Admin Profile</h3>
                                            </div>
                                            @if (session('successMessage'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation me-2 text-success"></i><strong>
                                                        {{ session('successMessage') }} </strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                            <hr>

                                            <div class="row">
                                                <div class="col-3 offset-2">
                                                    @if (Auth::user()->image == null)
                                                        @if (Auth::user()->gender == 'female')
                                                            <img src="{{ asset('image/female_default.jpg') }}"
                                                                class="img-thumbnail" />
                                                        @else
                                                            <img src="{{ asset('image/default.png') }}"
                                                                class="img-thumbnail" />
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" />
                                                    @endif

                                                    <a href="{{ route('edit#Profile') }}" class="mt-3">
                                                        <button class="btn btn-success text-white btn btn-sm p-2">
                                                            <i class="fa-regular fa-pen-to-square me-2"></i>Customize
                                                            Profile
                                                        </button>
                                                    </a>

                                                </div>
                                                <div class="col-6 offset-1">
                                                    <div class="my-3">
                                                        <i class="fa-solid fa-user me-3"></i>
                                                        <span>{{ Auth::user()->name }}</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-solid fa-envelope me-3"></i>
                                                        <span>{{ Auth::user()->email }}</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-solid fa-mobile-screen-button me-3"></i>
                                                        <span>{{ Auth::user()->phone }}</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-solid fa-location-dot me-3"></i>
                                                        <span>{{ Auth::user()->address }}</span>
                                                    </div>

                                                    <div class="my-3">
                                                        @if (Auth::user()->gender == 'female')
                                                            <i class="fa-solid fa-venus me-3"></i>
                                                        @else
                                                            <i class="fa-solid fa-mars-stroke me-3"></i>
                                                        @endif
                                                        <span>{{ Auth::user()->gender }}</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-solid fa-clock me-3"></i>
                                                        <span>{{ Auth::user()->created_at->format('j F Y') }}</span>
                                                    </div>

                                                </div>
                                            </div>
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

@extends('user.layouts.master')

@section('title', 'Contacts Us')

@section('content')
    <!-- Contact Start -->
    <div class="container-lg">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-10 mb-5">
                <div class="contact-form bg-light p-30">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2 text-success"></i><strong>
                                {{ session('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact#message', Auth::user()->id) }}" method="post">
                        @csrf
                        <div class="control-group mb-4">
                            <input type="text" class="form-control @error('userName') is-invalid @enderror"
                                name="userName" value="{{ old('userName') }}" placeholder="Enter your name">
                            @error('userName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <input type="email" class="form-control @error('userEmail') is-invalid @enderror"
                                name="userEmail" value="{{ old('userEmail') }}" placeholder="Enter your email">
                            @error('userEmail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea name="message" cols="75" class="form-control @error('message') is-invalid @enderror" rows="10"
                                placeholder="Write your message ..." style="resize: none">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

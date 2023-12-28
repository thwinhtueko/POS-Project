@extends('admin.layouts.master')

@section('title', 'Edit Profile')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- MAIN CONTENT-->
                    <div class="main-content">
                        <div class="section__content section__content--p30">
                            @error('terms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="container-fluid" style="height: 100vh">
                                <div class="col-lg-8 offset-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2 my-2">User Profile</h3>
                                            </div>
                                            <hr>

                                            <form action="{{ route('user#updateProfile', $profile[0]->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-4 offset-1">
                                                        @if ($profile[0]->image == null)
                                                            @if ($profile[0]->gender == 'female')
                                                                <img src="{{ asset('image/female_default.jpg') }}"
                                                                    class="img-thumbnail" />
                                                            @else
                                                                <img src="{{ asset('image/default.png') }}"
                                                                    class="img-thumbnail" />
                                                            @endif
                                                        @else
                                                            <img src="{{ asset('storage/' . $profile[0]->image) }}"
                                                                class="img-thumbnail" />
                                                        @endif

                                                        <input type="file" name="image"
                                                            class="form-control my-2 @error('image')is-invalid @enderror">

                                                        @error('image')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                        <button class="btn btn-dark offset-1 p-2 col-10 text-white">
                                                            <i class="fa-regular fa-pen-to-square me-2"></i>Update
                                                            Profile
                                                        </button>

                                                    </div>
                                                    <div class="col-6 offset-1">
                                                        <div class="h6 my-3">
                                                            <label for="userName">Name</label>
                                                            <input type="text" name="name" id="userName"
                                                                value="{{ old('name', $profile[0]->name) }}"
                                                                placeholder="Enter Admin Name"
                                                                class="form-control text-muted @error('name') is-invalid @enderror">

                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="h6 my-3">
                                                            <label for="date ">Date</label>
                                                            <input type="text" name="date" id="date"
                                                                value="{{ old('date', $profile[0]->created_at->format('j F Y')) }}"
                                                                readonly class="form-control text-muted">
                                                        </div>

                                                        <div class="h6 my-3">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                value="{{ old('email', $profile[0]->email) }}"
                                                                placeholder="Enter Admin Email"
                                                                class="form-control text-muted @error('email') is-invalid @enderror">

                                                            @error('email')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="h6 my-3">
                                                            <label for="userPhone">Phone</label>
                                                            <input type="tel" name="phone" id="phone"
                                                                value="{{ old('phone', $profile[0]->phone) }}"
                                                                placeholder="Enter Admin Phone"
                                                                class="form-control text-muted @error('phone') is-invalid @enderror">

                                                            @error('phone')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="h6 my-3 form-group">
                                                            <label for="gender">Gender</label>
                                                            <select name="gender" id="gender"
                                                                class="form-control @error('gender') is-invalid @enderror">
                                                                <option value="">select gender...</option>
                                                                <option value="male"
                                                                    @if ($profile[0]->gender == 'male') selected @endif>Male
                                                                </option>

                                                                <option value="female"
                                                                    @if ($profile[0]->gender == 'female') selected @endif>Female
                                                                </option>
                                                            </select>

                                                            @error('gender')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="h6 my-3">
                                                            <label for="address">Address</label>
                                                            <textarea name="address" id="address"class="form-control @error('address') is-invalid @enderror" cols="30"
                                                                rows="4" style="resize: none;"placeholder="Enter Admin Address">{{ old('address', $profile[0]->address) }}</textarea>

                                                            @error('address')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
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

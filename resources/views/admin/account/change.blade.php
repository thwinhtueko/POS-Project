@extends('admin.layouts.master')

@section('title', 'Change Role')

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
                                            <div class="card-title d-flex justify-content-between">
                                                <a href="{{ route('admin#list') }}">
                                                    <button class="btn btn-outline-light btn-sm text-dark rounded"><i
                                                            class="fa-solid fa-arrow-left me-1"></i>Back</button>
                                                </a>
                                                <span class="title-2 text-center d-inline-block">
                                                    {{ $roleData->name }}
                                                </span>

                                                <h5 class="d-inline-block text-muted" title="join date">
                                                    <i class="fa-regular fa-calendar-days me-1"></i>
                                                    {{ $roleData->created_at->format('j F Y') }}
                                                </h5>
                                            </div>
                                            <hr>

                                            <form action="{{ route('admin#updateRole', $roleData->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-3 offset-2">
                                                        @if ($roleData->image == null)
                                                            @if ($roleData->gender == 'female')
                                                                <img src="{{ asset('image/female_default.jpg') }}"
                                                                    class="img-thumbnail" />
                                                            @else
                                                                <img src="{{ asset('image/default.png') }}"
                                                                    class="img-thumbnail" />
                                                            @endif
                                                        @else
                                                            <img src="{{ asset('storage/' . $roleData->image) }}" />
                                                        @endif
                                                    </div>
                                                    <div class="col-6 offset-1">
                                                        <div class="my-2">
                                                            <label for="role">Change Role</label>
                                                            <select name="role" id="role"
                                                                class="form-control form-control-sm w-75">
                                                                <option value="admin"
                                                                    @if ($roleData->role == 'admin') selected @endif>Admin
                                                                </option>
                                                                <option value="user"
                                                                    @if ($roleData->role == 'user') selected @endif>User
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <input type="submit" value="Change" class="btn btn-primary btn-sm p-2 mt-3" />
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

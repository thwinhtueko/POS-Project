@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Address</th>
                                    <th>Change</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userData as $D)
                                    <tr>
                                        <input type="hidden" id="userId" value="{{ $D->id }}">
                                        <td class="col-1">
                                            @if ($D->image == null)
                                                @if ($D->gender == 'female')
                                                    <img src="{{ asset('image/female_default.jpg') }}" alt="product image"
                                                        class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('image/default.png') }}" alt="product image"
                                                        class="img-thumbnail">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $D->image) }}" alt="product image"
                                                    class="img-thumbnail">
                                            @endif
                                        </td>
                                        <td>{{ $D->name }} </td>
                                        <td class="col-1">{{ $D->email }} </td>
                                        <td>{{ $D->phone }} </td>
                                        <td>{{ $D->gender }} </td>
                                        <td>{{ $D->role }} </td>
                                        <td>{{ $D->address }} </td>
                                        <td class="w-10">
                                            <select class="form-control statusBtn">
                                                <option value="user" @if (Auth::user()->id == 'user') selected @endif>
                                                    User</option>
                                                <option value="admin" @if (Auth::user()->id == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('contact#edit', $D->id) }}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('user#remove', $D->id) }}">
                                                    <button class="item ms-2" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('AjaxSource')
    <script>
        $(document).ready(function() {

            $('.statusBtn').change(function() {

                $currentRole = $(this).val();

                $parent = $(this).parents('tr');
                $userId = $parent.find('#userId').val();

                $.ajax({

                    type: 'get',
                    url: '/user/role/change',
                    data: {
                        'userId': $userId,
                        'currentRole': $currentRole
                    },
                    dataType: 'json',
                });
                location.reload();
            });

        });
    </script>
@endsection

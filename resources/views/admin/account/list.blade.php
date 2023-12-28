@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>
                            </div>
                            @if (session('deleteSuccess'))
                                <div class="invalid-feedback">
                                    {{ session('deleteSuccess') }}
                                </div>
                            @endif
                        </div>

                        <div class="h6 bg-dark text-white p-2 rounded shadow-sm">
                            <span><i class="fa-solid fa-user-shield me-2"></i>{{ $admin->total() }}</span>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#create') }}">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('admin#list') }}" method="get">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <input type="text" name="Key" value="{{ request('Key') }}" class="form-control w-25"
                                placeholder="Search..">
                            <button class="btn btn-dark rounded">
                                Search
                            </button>
                        </div>
                    </form>

                    <h4 class="mb-4 text-success">Search Key: <span class="text-muted d-inline-block"> {{ request('Key') }}
                        </span></h4>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 shadow-sm">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Join Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr>
                                        <input type="hidden" class="roleId" value="{{ $a->id }}">
                                        <td>
                                            @if ($a->image == null)
                                                @if ($a->gender == 'female')
                                                    <img src="{{ asset('image/female_default.jpg') }}" alt="product image"
                                                        class="img-thumbnail" style="width: 120px">
                                                @else
                                                    <img src="{{ asset('image/default.png') }}" alt="product image"
                                                        class="img-thumbnail" style="width: 120px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}" alt="product image"
                                                    class="img-thumbnail" style="width: 120px">
                                            @endif
                                        </td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>{{ $a->created_at->format('j F Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if ($a->id == Auth::user()->id)
                                                    <!---id is same not showing button--->
                                                @else
                                                    <select class="form-control me-3 roleBtn" data-toggle="tooltip"
                                                        data-placement="top" title="Role Change">
                                                        <option value="admin"
                                                            @if (Auth::user()->id == 'admin') selected @endif>admin</option>
                                                        <option value="user"
                                                            @if (Auth::user()->id == 'user') selected @endif>user</option>
                                                    </select>

                                                    <a href="{{ route('admin#changeRole', $a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="change">
                                                            <i class="zmdi zmdi-plus"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $admin->links() }}
                        </div>
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

            $('.roleBtn').change(function() {

                $parent = $(this).parents('tr');
                $roleId = $parent.find('.roleId').val();

                $currentRole = $(this).val();

                $data = {
                    'roleId': $roleId,
                    'currentRole': $currentRole
                };

                $.ajax({
                    type: 'get',
                    url: '/admin/ajax/role',
                    data: $data,
                    dataType: 'json',

                })
                location.reload();
            })

        })
    </script>
@endsection

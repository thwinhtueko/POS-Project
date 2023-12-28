@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        @if (count($data) != 0)
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Send Date</th>
                                        <th>Message</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="tr-shadow">
                                            <td> {{ $d->name }} </td>
                                            <td> {{ $d->email }} </td>
                                            <td> {{ $d->created_at->format('j F Y') }} </td>
                                            <td> {{ Str::limit($d->message, '50', ' . . . . .') }}</td>
                                            <td class="col-1">
                                                <div class="table-data-feature">
                                                    <a href="{{ route('contact#readMessage', $d->id) }}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="View Message">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('contact#delete', $d->id) }}">
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
                        @else
                            <div class="text-center mt-5">
                                <h3 class="text-muted">There is no mesage</h3>
                            </div>
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

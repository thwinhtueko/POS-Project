@extends('user.layouts.master')

@section('title', 'Order History')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 350px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Detail</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($history as $h)
                            <tr>
                                <td class="align-middle"> {{ $h->created_at->format('F j Y') }} </td>
                                <td class="align-middle"> {{ $h->order_code }} </td>
                                <td class="align-middle"> {{ $h->total_price }} </td>
                                <td class="align-middle ">
                                    @if ($h->status == 0)
                                        <h6 class="text-dark"> Pending</h6>
                                    @elseif ($h->status == 1)
                                        <h6 class="text-success"> Success</h6>
                                    @elseif ($h->status == 2)
                                        <h6 class="text-danger"> Rejected</h6>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($h->status == 0)
                                        <i class="fa-regular fa-hourglass text-dark"></i>
                                    @elseif ($h->status == 1)
                                        <i class="fa-solid fa-check text-success"></i>
                                    @elseif ($h->status == 2)
                                        <i class="fa-solid fa-exclamation text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $history->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

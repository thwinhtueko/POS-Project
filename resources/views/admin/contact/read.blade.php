@extends('admin.layouts.master')

@section('title', 'Read Message')

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
                                                <h4 class="text-center title-2">Read Message</h4>
                                            </div>
                                            <div class="row">
                                                <div class="offset-1 col-10 offset-1 mt-2 mb-4">
                                                    <textarea name="message"class="form-control rounded" readonly cols="30" rows="7" style="resize: none">{{ $read->message }}</textarea>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-dark text-white rounded"
                                                        onclick="history.back()">Back</button>

                                                    <span class="me-2">
                                                        <i
                                                            class="fa-regular fa-calendar-days me-1"></i>{{ $read->created_at->format('j M Y') }}
                                                    </span>
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

@extends('layouts.index')

@push('styles')
    @include('order.style')
@endpush
@section('content')

<section class="content">

    <div class="container mt-3">
        <div class="card card-primary card-outline card-tabs">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-warning h4"><i class="fas fa-map-marker-alt"></i>&nbsp;Delivery Address</p>
                        </div>
                        <div class="col-md-4 offset-md-5 append_address_button">
                            @if(empty($active_address))
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#addressModal"><i class="fa fa-plus"></i> Add Address</button>&nbsp;
                                    {{-- <button class="btn btn-light"><i class="fa fa-plus"></i> Manage Address</button> --}}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="append_addresses">
                        @if(!empty($active_address))
                            <div class="row">
                                <div class="col-md-3">
                                    <p><strong>{{Auth::user()->fullname}}</strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{$active_address->other_details}},{{$active_address->barangay}}, {{$active_address->city}}, {{$active_address->province}}, {{$active_address->region}}
                                </div>
                                <div class="col-md-1">
                                    <p class=" text-info">Default</p>
                                </div>
                                <div class="col-md-1">
                                    <a href="#" class="change_button">Change</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        <div class="card no_radius mb-2">
            <div class="card-body p-2">
                <div class="row">
                    
                    <div class="col-md-2 offset-md-1">
                        <h5 class="h6 text-center">Product</h5>
                    </div>
                    <div class="col-md-2 offset-md-1">
                        <h5 class="h6 text-center">Unit Price</h5>
                    </div>
                    <div class="col-md-2">
                        <h5 class="h6 text-center">Quantity</h5>
                    </div>
                    <div class="col-md-2">
                        <h5 class="h6 text-center">Total Price</h5>
                    </div>
                    <div class="col-md-2">
                        <h5 class="h6 text-center">Actions</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="append_here">
            {{-- @foreach($data as $dt)
            <div class="card no_radius mb-2">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-1">
                            <input type="checkbox" class="checkMe">
                        </div>
                        <div class="col-md-2">
                            <h5 class="h6">{{$dt['variety']}}</h5>
                            <img class="img-thumbnail" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/No_image_available_600_x_450.svg/1280px-No_image_available_600_x_450.svg.png" alt="Colorlib Template">
                                <div class="overlay"></div>      
                        </div>
                        <div class="col-md-2 offset-md-1">
                            <h5 class="h6 text-center">600</h5>
                        </div>
                        <div class="col-md-2">
                            <div class="qty_wrapper1 m-auto">
                            <button class="minus1"></button>
                            <input type="number" min="0" value="{{$dt['quantity']}}" name="quantity" class="quantity1">
                            <button class="plus1"></button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h5 class="h6 text-center">{{600*$dt['quantity']}}</h5>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="text-center">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach --}}
        </div>

    </div>
    <div class="cart-footer">
        <div class="container">
            <div class="card no_radius">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 offset-md-7">
                            <h6>Merchandise Subtotal Price:<strong class="subtotal h6"> &nbsp;₱ 0</strong></h6>
                        </div>
                        <div class="col-md-2 ">
                            <button class="btn btn-lg btn-success checkout_btn">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('cart.modal_address')
@endsection

@push('scripts')
    @include('cart.script')
@endpush
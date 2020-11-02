@extends('layouts.index')

@push('styles')
    @include('order.style')
@endpush
@section('content')

<section class="content">
    <div class="container append_here mt-3">
        <div class="card no_radius mb-2">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-1">
                        <input type="checkbox" id="selectAll">
                    </div>
                    <div class="col-md-2">
                        <h5 class="h6">Product</h5>
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

        @foreach($data as $dt)
        <div class="card no_radius mb-2">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-1">
                        <input type="checkbox" class="checkMe">
                    </div>
                    <div class="col-md-2">
                        <h5 class="h6">{{$dt['variety']}}</h5>
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
        @endforeach

    </div>
    <div class="cart-footer">
        <div class="container">
            <div class="card no_radius">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 offset-md-8">
                            <h6>Total Price:<strong>800</strong></h6>
                        </div>
                        <div class="col-md-2 ">
                            <button class="btn btn-lg btn-danger">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @include('cart.script')
@endpush
@extends('layouts.index')

@push('styles')

@endpush
@section('content')

<section class="content">

    <div class="container mt-3">
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
            
        </div>

    </div>
    <div class="cart-footer">
        <div class="container">
            <div class="card no_radius">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 offset-md-7">
                            <h6>Total Price:<strong class="subtotal h6"> &nbsp;₱ 0</strong></h6>
                        </div>
                        <div class="col-md-2 ">
                            <button class="btn btn-lg btn-success reserve_btn">Reserve Now</button>
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
@extends('layouts.index')

@push('styles')
    @include('shop.style')
@endpush
@section('content')

<div class="content">
    <div class="container append_here mt-3">
        <div class="row" id="append_seed">
            @foreach($data as $dt)
            <div class="col-md-6 col-lg-3">
                <div class="card product_detail_button" data-id="{{$dt['variety']}}">
                    <div class="card-body">
                        <a href="#" class="img-prod"><img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/No_image_available_600_x_450.svg/1280px-No_image_available_600_x_450.svg.png" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                        <div class="text text-center">
                            <h3><a href="#">{{$dt['variety']}}</a></h3>
                            <div class="text-center">
                                <p class="text-center">Php 80.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($data->hasPages())
            {{$data->links()}}
        @endif
    </div>
</div>
    

@include('shop.product_details')
@endsection

@push('scripts')
    <script type="text/javascript" src="{{asset('public/js/shop.js')}}?v=1"></script>
@endpush
@extends('layouts.index')

@section('content')
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item" {{-- style="background-image: url(images/bg_1.jpg);" --}}>
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-12 ftco-animate text-center">
                    <h1 class="mb-2">We serve quality seeds</h1>
                    <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                    <p><a href="#" class="btn btn-primary">View Details</a></p>
                </div>

                </div>
            </div>
        </div>

        <div class="slider-item" {{-- style="background-image: url(images/bg_2.jpg);" --}}>
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-sm-12 ftco-animate text-center">
                    <h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
                    <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                    <p><a href="#" class="btn btn-primary">View Details</a></p>
                </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row" id="append_seed">
            @foreach($data as $dt)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{$dt->variety}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="price">$80.00</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                    <span><i class="ion-ios-heart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              {{$data->links()}}
            </div>
          </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @include('order.script')
@endpush
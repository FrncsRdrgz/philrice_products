
        <div class="row" id="append_seed">
            @foreach($data as $dt)
            <div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">
                <div class="product">
                    <a href="#" class="img-prod"><img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/No_image_available_600_x_450.svg/1280px-No_image_available_600_x_450.svg.png" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{$dt->variety}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="price">$80.00</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="#" data-id="{{$dt->seedVarietyId}}" class="product_detail_button add-to-cart d-flex justify-content-center align-items-center text-center mx-1" title="Product detail">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
{{--                                 <a href="#" data-id="{{$dt->seedVarietyId}}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a> --}}
                                <a href="#" data-id="{{$dt->seedVarietyId}}" class="heart d-flex justify-content-center align-items-center ">
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

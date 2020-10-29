<nav class="main-header navbar navbar-expand navbar-dark navbar-success mb-4">
	<div class="container">	  

	  @if(Request::segment(1) == 'checkout')
	  <a class="navbar-brand"  href="{{url('/')}}">PhilRice Products | Checkout</a>
	  @else
	  <a class="navbar-brand" href="{{url('/')}}">PhilRice Products</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="oi oi-menu"></span> Menu
	  </button>

	  <div class="collapse navbar-collapse">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
	      <li class="nav-item"><a href="{{url('/shop')}}" class="nav-link">Shop</a></li>
{{-- 	      <li class="nav-item"><a href="#" class="nav-link">About</a></li>
	      <li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
	      <li class="nav-item"><a href="#" class="nav-link">Contact</a></li> --}}
	      <li class="nav-item cta cta-colored cart_trigger_button"><a href="javascript:void();" class="nav-link"><span class="fa fa-shopping-cart"></span>[0]</a></li>

	    </ul>
	  </div>
	  @endif
	</div>
</nav>
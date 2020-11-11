@extends('layouts.index')

@section('content')
	<section class="content">
		<div class="container mt-3">
			<div class="card card-primary card-outline card-tabs">
				<div class="card-body">

					<p><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;Delivery Address</p>
				</div>
			</div>
		</div>
	</section>
@endsection

@push('scripts')
    @include('checkout.script')
@endpush
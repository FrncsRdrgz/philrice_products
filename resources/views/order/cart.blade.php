@extends('layouts.index')

@push('styles')
    @include('order.style')
@endpush
@section('content')

<section class="content">
    <div class="container append_here mt-3">
        <div class="row" id="append_seed">
            
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @include('order.script')
@endpush
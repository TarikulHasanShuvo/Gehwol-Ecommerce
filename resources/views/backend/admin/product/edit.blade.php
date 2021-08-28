@extends('backend.layouts.app')
@section('content')
    <product-edit-component product_id="{{ $productId }}"></product-edit-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
@extends('backend.layouts.app')
@section('content')
    <product-create-component></product-create-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
@extends('backend.layouts.app')
@section('content')
    <product-component></product-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush


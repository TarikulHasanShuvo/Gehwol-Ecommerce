@extends('backend.layouts.app')
@section('content')
    <order-component></order-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush


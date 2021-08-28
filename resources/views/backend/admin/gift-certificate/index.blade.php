@extends('backend.layouts.app')

@section('content')
    <gift-certificate-component></gift-certificate-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
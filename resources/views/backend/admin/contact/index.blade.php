@extends('backend.layouts.app')

@section('content')
    <contact-component></contact-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
@extends('backend.layouts.app')

@section('content')
    <blog-component></blog-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
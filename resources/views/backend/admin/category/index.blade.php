@extends('backend.layouts.app')

@section('content')
    <category-component></category-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
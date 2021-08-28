@extends('backend.layouts.app')

@section('content')
    <subscription-component></subscription-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush

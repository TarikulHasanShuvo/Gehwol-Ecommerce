@extends('backend.layouts.app')

@section('content')
    <event-component></event-component>
@endsection

@push('js')
    <script src="{{mix('js/app.js')}}"></script>
@endpush

@extends('backend.layouts.app')

@section('content')
<whole-sale-component></whole-sale-component>
@endsection

@push('js')
<script src="{{mix('js/app.js')}}"></script>
@endpush
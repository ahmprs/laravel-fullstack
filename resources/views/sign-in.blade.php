@extends('master')
@section('page_title', 'products')

@section('content')
    @component('cmp-sign-in')
        @slot('id')
            cmp_sign_in
        @endslot
    @endcomponent
@stop

@section('footer')

@stop

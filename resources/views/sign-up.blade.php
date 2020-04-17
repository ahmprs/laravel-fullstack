@extends('master')
@section('page_title', 'products')

@section('content')
    @component('cmp-sign-up')
        @slot('id')
            cmp_sign_up
        @endslot
    @endcomponent
@stop

@section('footer')

@stop

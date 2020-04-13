@extends('master')
@section('page_title', 'products')

@section('content')
    @component('cmp-signup')
        @slot('id')
            cmp_signup
        @endslot
    @endcomponent
@stop

@section('footer')

@stop

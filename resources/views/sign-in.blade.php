@extends('master')
@section('page_title', 'products')

@section('content')
    @component('cmp-sign-in')
        @slot('id')
            cmp_sign_in
        @endslot
        @slot('root_url')
            {{$root_url}}
        @endslot
    @endcomponent
@stop

@section('footer')

@stop

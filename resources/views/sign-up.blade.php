@extends('master')
@section('page_title', 'products')

@section('content')
    @component('cmp-sign-up')
       @slot('id')
            cmp_sign_up
        @endslot
        @slot('root_url')
            {{$root_url}}
        @endslot
    @endcomponent
@stop

@section('footer')

@stop

@extends('master')
@section('page_title', 'TEST')
@section('content')
    @component('cmp-add')
        @slot('id')
            cmp_test_add_1
        @endslot
    @endcomponent

    @component('cmp-add')
        @slot('id')
            cmp_test_add_2
        @endslot
    @endcomponent

@stop

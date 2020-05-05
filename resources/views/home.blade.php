@extends('master')
@section('page_title', 'home')
@section('content')
    <h3>HOME HERE</h3>
    @component('cmp-add')
        @slot('id')
            cmp_add_one
        @endslot
    @endcomponent
@stop


@section('footer')
    <h3>
        this is also added to normal footer
    </h3>
@stop

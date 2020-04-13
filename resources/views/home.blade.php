@extends('master')
@section('page_title', 'home')

@section('content')
    <h3>HOME HERE</h3>
    <h2>cnt: {{$cnt}}</h2>

    @component('cmp-add')
        @slot('id')
            cmp1
        @endslot
    @endcomponent
    <hr>
    @component('cmp-add')
        @slot('id')
            cmp2
        @endslot
    @endcomponent

@stop

@section('footer')
    <h3>
        this is also added to normal footer
    </h3>
@stop

@extends('master')
@section('page_title', 'TEST')
@section('content')
    <h1>TEST 1</h1>
    @component('cmp-doc',['id'=>'cmp_doc_1'])
    @endcomponent

@stop

@section('footer')

@stop

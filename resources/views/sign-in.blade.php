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

    @component('cmp-account-manage',['id'=>'cmp_account_manage'])
    @endcomponent
@stop

@section('footer')

@stop

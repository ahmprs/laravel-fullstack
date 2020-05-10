@extends('master')
@section('page_title', 'TEST')
@section('content')

    @component('cmp-tab-pages', [
        'id'=>'cmp_tab_pages_test',
        'arr_buttons'=>['BTN0', 'BTN1', 'BTN2'],
    ])
        @section('pages')
            <div pin="0" class='d-none'>
                @component('cmp-add', ['id'=>'cmp_add_1'])
                @endcomponent
            </div>

            <div pin="1" class='d-none'>
                <p>123</p>
            </div>

            <div pin="2" class='d-none'>
                <p>456</p>
            </div>

        @stop
    @endcomponent
@stop

@section('footer')

@stop

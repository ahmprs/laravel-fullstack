@extends('master')
@section('page_title', 'products')

@section('content')
    <h3>
        PRODUCTS HERE
    </h3>
    <?php
        for($i=0;$i<2;$i++){
            ?>
                @component('cmp-pdf')
                @slot('id')
                    cmp_pdf_{{$i}}
                @endslot
                @slot('root_url')
                    {{$root_url}}
                @endslot
                @slot('file_url')
                    {{$root_url}}/posts/20200421-13990202-010235-00001.pdff
                @endslot
                @endcomponent
            <?php  
        }
    ?>
@stop

@section('footer')

@stop

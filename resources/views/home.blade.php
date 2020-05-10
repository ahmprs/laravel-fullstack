@extends('master')
@section('page_title', 'home')
@section('content')
    <h3 class="dark round center p-2">
        HOME
    </h3>
    
    <?php
    $gdp_now = (int)$calendar->getServerGdp();
    $records = 
        DB::table('tbl_files')
            ->select(
                'file_id', 
                'file_org_name', 
                'file_new_name', 
                'file_show',
                'file_gdp_create',
                'file_gdp_publish',
                'file_gdp_expires',
                'file_tag',
                'file_title',
                'file_desc'
            )
        ->where('file_tag','=','PRODUCTS')
        ->where('file_show','=','1')
        ->where('file_gdp_publish','<=', $gdp_now)
        ->where('file_gdp_expires','>=', $gdp_now)
        ->get();

        $i=0;
        foreach ($records as $f){
            ?>
                @component('cmp-pdf')
                    @slot('id')
                        cmp_pdf_{{$i}}
                    @endslot
                    @slot('root_url')
                        {{$root_url}}
                    @endslot
                    @slot('file_url')
                        {{$root_url}}/posts/{{$f->file_new_name}}
                    @endslot
                @endcomponent
            <?php  
            $i++;
        }
    ?>

@stop


@section('footer')
@stop

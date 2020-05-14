@extends('master')
@section('page_title', 'products')

@section('content')
    <h3 class="dark round center p-2">
        CUSTOMER SERVICE
    </h3>
    <?php
    $gdp_now = $calendar->getServerGdp();
    $tbl_div_docs_records = DB::table('tbl_div_docs')
        ->where('doc_tag','=','CUSTOMERS')
        ->where('doc_show','=','1')
        ->where('doc_gdp_publish','<=', $gdp_now)
        ->where('doc_gdp_expires','>=', $gdp_now)
        ->get();
        $i=0;
        foreach ($tbl_div_docs_records as $rec){
            ?>
            @component('cmp-doc',['id'=>"cmp_doc_$i", 'rec'=>$rec])
            @endcomponent
            <?php  
            $i++;
        }

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
        ->where('file_tag','=','CUSTOMERS')
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

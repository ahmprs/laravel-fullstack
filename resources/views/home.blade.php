@extends('master')
@section('page_title', 'home')
@section('content')

    <?php
        use App\Util as u;
        if(u::userIsAdmin()){
            ?>
                @component('cmp-content-menu',['id'=>'mnuMain', 'section'=>'HOME'])
                @endcomponent
            <?php
        }
    ?>

    <?php
    $gdp_now = $calendar->getServerGdp();

    $tbl_div_docs_records = DB::table('tbl_div_docs')
        ->where('doc_tag','=','HOME')
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

        $tbl_plugins_records = DB::table('tbl_plugins')
        ->where('plg_tag','=','HOME')
        ->where('plg_show','=','1')
        ->where('plg_gdp_publish','<=', $gdp_now)
        ->where('plg_gdp_expires','>=', $gdp_now)
        ->get();

        $i=0;
        foreach ($tbl_plugins_records as $rec){
            ?>
                @component('cmp-plugin',['id'=>'cmp_plugin', 'rec'=>$rec])
                @endcomponent
            <?php  
            $i++;
        }


    $tbl_files_records = 
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
        ->where('file_tag','=','HOME')
        ->where('file_show','=','1')
        ->where('file_gdp_publish','<=', $gdp_now)
        ->where('file_gdp_expires','>=', $gdp_now)
        ->get();

        $i=0;
        foreach ($tbl_files_records as $f){
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

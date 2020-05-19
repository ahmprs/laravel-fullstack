@extends('master')
@section('page_title', $page_title)
@section('content')
@yield('pre_active_content')
<?php
    use App\Util as u;
    
    // If the user is admin let them have access to
    // add new items such as plugins, div_docs, and articles
    if(u::userIsAdmin()){
        echo view(
            'cmp-content-menu',
            [
                'id'=>'mnuMain',
                'section'=>$sec
            ]);
    }

    // extract server date-time in the form of gdp
    $gdp_now = $calendar->getServerGdp();

    // Query for div_docs
    $tbl_div_docs_records = DB::table('tbl_div_docs')
        ->where('doc_tag','=',$sec)
        ->where('doc_show','=','1')
        ->where('doc_gdp_publish','<=', $gdp_now)
        ->where('doc_gdp_expires','>=', $gdp_now)
        ->get();

    // present each div_doc
    $i=0;
    foreach ($tbl_div_docs_records as $rec){
        echo view ('cmp-doc',['id'=>"cmp_doc_$i", 'rec'=>$rec]);
        $i++;
    }

    // Fetch plugins
    $tbl_plugins_records = DB::table('tbl_plugin_uses')
        ->join('tbl_plugins','tbl_plugin_uses.plg_id','=','tbl_plugins.plg_id')
        ->where('plg_tag','=', $sec)
        ->where('plg_show','=','1')
        ->where('plg_gdp_publish','<=', $gdp_now)
        ->where('plg_gdp_expires','>=', $gdp_now)
        ->select('tbl_plugins.*', 'tbl_plugin_uses.rec_id','tbl_plugin_uses.plg_gdp_create','tbl_plugin_uses.plg_gdp_publish','tbl_plugin_uses.plg_gdp_expires','tbl_plugin_uses.plg_show','plg_tag')
        ->get();

    // Present plugins 
    for($i=0;$i<count($tbl_plugins_records); $i++){
        $rec = $tbl_plugins_records[$i];
        echo view('cmp-plugin', ['id'=>'cmp_plugin_'.$i, 'rec'=>$rec]);
    }

    // Fetch articles (PDF docs)
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
        ->where('file_tag','=', $sec)
        ->where('file_show','=','1')
        ->where('file_gdp_publish','<=', $gdp_now)
        ->where('file_gdp_expires','>=', $gdp_now)
        ->get();

    
    // Present articles
    $i=0;
    foreach ($tbl_files_records as $f){
        echo view ('cmp-pdf',[
            'id'=>"cmp_pdf_$i",
            'root_url'=>$root_url,
            'file_url'=>"$root_url/posts/$f->file_new_name"
        ]);
        $i++;
    }
    ?>
@yield('post_active_content')
@stop

@section('footer')
@stop

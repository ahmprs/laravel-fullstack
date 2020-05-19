<?php
    use App\Calendar;
    use App\Util as u;

    $calendar = new Calendar();
    
    $plg_id = $rec->plg_id;
    $plg_js_code= $rec->plg_js_code;
    $plg_ts_code= $rec->plg_ts_code;
    $plg_js_plain= $rec->plg_js_plain;
    $plg_cls = $rec->plg_cls;
    $plg_init = $plg_cls.".init('".$id."_div_app'".");";
    $content_editable="contenteditable";
?>
<div id="{{{$id}}}" class="p-1 round dark">

<!-- TAB PAGES HERE -->
<?php 

$p0 = <<<HTML
<div pin="0">
    <div id="{$id}_div_app" class="round" style="background-color: white; color: #000; padding:5px 10px;">
    </div>

    <script id="{$id}_div_app_script">
    $plg_js_plain
    $plg_init
    </script>
</div>
HTML;


$p1 = <<<HTML
    <div pin="1" class='d-none'>
        <div id="{$id}_div_ts_code" class="p-2 dark round" $content_editable>
        $plg_ts_code
        </div>
    </div>
HTML;


$p2 = <<<HTML
    <div pin="2" class='d-none p-2 dark round' >
        <div id="{$id}_div_js_code" class="p-2" $content_editable >
        $plg_js_code
        </div>
    </div>

HTML;

    echo view('cmp-tab-pages', [
        'id'=>$id."_tab_pages",
        'arr_buttons'=>['App', 'TS Code', 'JS Code'],
        'arr_pages'=>[
            $p0, $p1, $p2
        ]
    ]);
?>
    <button id="{{{$id}}}_btn_menu" class="btn btn-secondary">...</button>
    <div id="{{{$id}}}_div_menu" class="d-none round light">
        <h3 class="round bg-blue center">Edit Code</h3>
        <button id="{{{$id}}}_btn_hide_menu" class="btn btn-danger float-right mr-1 mt-1">&times;</button>

        <span>Class Name</span>
        <input type="text" id="{{{$id}}}_txt_plugin_cls" class='form-control col-md-4 mb-1' placeholder="Class Name" value="{{{$plg_cls}}}">

        <button id="{{{$id}}}_btn_save" class="btn btn-success">SAVE</button>
        <button id="{{{$id}}}_btn_delete" class="btn btn-danger">DELETE</button>
    </div>

<script>
    CmpPluginCode.init("{{{$id}}}", "{{{$plg_id}}}");
</script>
</div>
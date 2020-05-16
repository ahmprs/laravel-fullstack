<?php
    use App\Calendar;
    use App\Util as u;

    $calendar = new Calendar();
    $plg_id = $rec->plg_id;
    $plg_show = $rec->plg_show;
    $plg_tag = $rec->plg_tag;

    // $plg_js_code= u::codeToString ($rec->plg_js_code);
    // $plg_ts_code= u::codeToString ($rec->plg_ts_code);

    $plg_js_code= $rec->plg_js_code;
    $plg_ts_code= $rec->plg_ts_code;
    $plg_js_plain= $rec->plg_js_plain;
?>


<div id="{{{$id}}}" class="p-1 round dark">

    <!-- TAB PAGES HERE -->
    @component('cmp-tab-pages', [
            'id'=>$id."_tab_pages",
            'arr_buttons'=>['JS Code', 'TS Code', 'App'],
        ])
            @section('pages')
            <div pin="0" class='d-none p-2 dark round' >
                <div id="{{{$id}}}_div_js_code" class="p-2" contenteditable>
                    <?php echo($plg_js_code); ?>
                </div>
            </div>

            <div pin="1" class='d-none'>
                <div id="{{{$id}}}_div_ts_code" class="p-2 dark round" contenteditable>
                    <?php echo($plg_ts_code); ?>
                </div>
            </div>

            <div pin="2">
                <div id="{{{$id}}}_div_app">
                </div>

                <script id="{{{$id}}}_div_app_script">
                    <?php echo($plg_js_plain); ?>
                </script>
            </div>
            @stop
        @endcomponent
    <!-- TAB PAGES END -->

    @if(u::userIsAdmin())
            <button id="{{{$id}}}_btn_menu" class="btn btn-secondary">...</button>
            <div id="{{{$id}}}_div_menu" class="d-none round light">
                <h3 class="round bg-blue center">Edit Meta</h3>
                <button id="{{{$id}}}_btn_hide_menu" class="btn btn-danger float-right mr-1 mt-1">&times;</button>

                <span>PUBLISH:</span>
                <select tag="{{{$plg_show}}}" id="{{{$id}}}_cmb_publish" class="btn btn-warning">
                    <option value="NO">NO</option>
                    <option value="YES">YES</option>
                </select>
                <br>

                <span>PUBLISH STARTS AT:</span>
                @component('cmp-calendar', ['id'=>"{$id}_plg_gdp_publish", 'calendar'=>$calendar, 'base_gdp'=>$rec->plg_gdp_publish])
                @endcomponent
                
                <span>PUBLISH EXPIRES AT:</span>
                @component('cmp-calendar', ['id'=>"{$id}_plg_gdp_expires", 'calendar'=>$calendar, 'base_gdp'=>$rec->plg_gdp_expires])
                @endcomponent

                <span>SECTION:</span>
                <select tag="{{{$plg_tag}}}" id="{{{$id}}}_cmb_section" class='btn btn-secondary'>
                    <option value="HOME">HOME</option>
                    <option value="PRODUCTS">PRODUCTS</option>
                    <option value="CONTACTS">CONTACTS</option>
                    <option value="ORDERS">ORDERS</option>
                    <option value="CUSTOMERS">CUSTOMERS</option>
                    <option value="OFFERS">OFFERS</option>
                </select>
                <hr>
                <button id="{{{$id}}}_btn_reload" class="btn btn-primary">RELOAD</button>
                <button id="{{{$id}}}_btn_save" class="btn btn-success">SAVE</button>
                <button id="{{{$id}}}_btn_clear" class="btn btn-secondary">CLEAR</button>
                <button id="{{{$id}}}_btn_delete" class="btn btn-danger">DELETE</button>
            </div>
        @endif

<script>
    CmpPlugin.init("{{{$id}}}", "{{{$plg_id}}}");
</script>
</div>
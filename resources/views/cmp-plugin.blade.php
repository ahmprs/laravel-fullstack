<?php
    use App\Calendar;
    use App\Util as u;
    
    $calendar = new Calendar();
    
    $plg_id = $rec->plg_id;
    $rec_id = $rec->rec_id;
    $plg_show = $rec->plg_show;
    $plg_tag = $rec->plg_tag;
    $is_admin = u::userIsAdmin();
    $plg_cls = $rec->plg_cls;
    $plg_init = $plg_cls.".init('".$id."_div_app'".");";
    $plg_js_plain = $rec->plg_js_plain;

    // GET ALL PLUGINS
    $plugins = DB::table('tbl_plugins')->get();
?>

<!-- PLUGIN DIV -->
<div id="{{{$id}}}" class="p-1 round dark">
    @if(u::userIsAdmin())

    <!-- APP DIV HERE -->
    <div id="{{{$id}}}_div_app" class="round" style="background-color:white; color:#000; padding:5px 10px;">
    </div>

    <!-- PLUGIN SCRIPT -->
    <script id="{{{$id}}}_div_app_script">
        <?php echo($plg_js_plain); ?>
        <?php echo($plg_cls.".init('".$id."_div_app'".");"); ?>
    </script>

    <!-- PLUGIN META CONTROL -->
    <button id="{{{$id}}}_btn_menu" class="btn btn-secondary">...</button>
    <div id="{{{$id}}}_div_menu" class="d-none round light p-2">
        <h3 class="round bg-blue center">Edit Meta</h3>
        <button id="{{{$id}}}_btn_hide_menu" class="btn btn-danger float-right mr-1 mt-1">&times;</button>

        <span>Class Name</span>
        <select tag="{{{$plg_cls}}}" id="{{{$id}}}_cmb_plugin_cls" class="btn btn-primary form-control col-md-2 d-block">
        <?php
            for($i=0;$i<count($plugins); $i++){
                $v = $plugins[$i]->plg_cls;
                $plg_id = $plugins[$i]->plg_id;
                echo "<option tag='$plg_id' value='$v'>$v</option>";
            }
        ?>
        </select>

        <span>PUBLISH:</span>
        <select tag="{{{$plg_show}}}" id="{{{$id}}}_cmb_publish" class="btn btn-warning form-control col-md-2 d-block">
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
        <select tag="{{{$plg_tag}}}" id="{{{$id}}}_cmb_section" class='btn btn-secondary form-control col-md-2 d-block'>
            <option value="HOME">HOME</option>
            <option value="PRODUCTS">PRODUCTS</option>
            <option value="CONTACTS">CONTACTS</option>
            <option value="ORDERS">ORDERS</option>
            <option value="CUSTOMERS">CUSTOMERS</option>
            <option value="OFFERS">OFFERS</option>
        </select>
        <hr>
        
        <button id="{{{$id}}}_btn_save" class="btn btn-success">SAVE</button>
        <button id="{{{$id}}}_btn_delete" class="btn btn-danger">DELETE</button>
    </div>

    @else
    <!-- NON ADMIN PLUGIN CONTENT -->
    <div id="{{{$id}}}_div_app" class="round" style="background-color:white; color:#000; padding:5px 10px;">
    </div>
    <!-- PLUGIN SCRIPT HERE -->
    <script id="{{{$id}}}_div_app_script">
        <?php echo($plg_js_plain); ?>
        <?php echo($plg_cls.".init('".$id."_div_app'".");"); ?>
    </script>
    @endif

<!-- STARTER SCRIPT -->
<script>
    CmpPlugin.init("{{{$id}}}", "{{{$plg_id}}}", "{{{$rec_id}}}");
</script>
</div>
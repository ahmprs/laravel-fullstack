<div id="{{{$id}}}">
<?php
    $records = DB::table('tbl_settings')->get();

    $cnt=0;
    foreach($records as $stg){
        $stg_id = $id."_".$cnt;
        ?>
        @component('cmp-setting', ['id'=>$stg_id, 'stg'=>$stg])
        @endcomponent
        <?php
        $cnt++;
    }
?>


</div>

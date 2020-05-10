<div id="{{{$id}}}" class="round light p-2">
<?php
    use App\calendar;
    $calendar = new Calendar();

    $stg_caption = $stg->stg_caption;
    $stg_key = $stg->stg_key;
    $stg_val = $stg->stg_val;
    $stg_options = $stg->stg_options;
    $stg_type = $stg->stg_type;
    $stg_max = $stg->stg_max;
    $stg_min = $stg->stg_min;

    $mrk  = '';
    echo ('<span>');
    echo ($stg_caption);
    echo ('</span>');
    
    switch($stg_type){
        case 'option':
            $arr_options = explode(';', $stg_options);
            echo ("<select stg_val='{$stg_val}' id='{$id}_cmb_option' class='form-control col-md-8'>");
            for($i=0;$i<count($arr_options);$i++){
                $op = trim($arr_options[$i]);
                echo ("<option value='$op'>");
                echo ($op);
                echo ('</option>');
            }
            echo ('<select>');
            break;

        case 'gdp':
            ?>
            @component('cmp-calendar', ['calendar'=>$calendar, 'base_gdp'=>$stg_val])
            @slot('id')
                {{$id}}_cmp_cal
            @endslot
            @endcomponent
            <?php
            break;

        case 'text':
            echo ("<input id='{$id}_txt_text' class='form-control col-md-8' type='text' placeholder='$stg_caption' value='$stg_val' >");
            break;
        case 'number':
            echo ("<input id='{$id}_txt_number' class='form-control col-md-8' type='number' placeholder='$stg_caption' value='$stg_val' min='$stg_min' max='$stg_max' >");
            break;
    }
    echo ("<button class='btn btn-secondary d-none form-control col-md-8' id='{$id}_btn_save'>SAVE CHANGES</button>");

?>
</div>
<hr>
<script>
    CmpSetting.init("{{$id}}", "{{$stg_type}}", "{{$stg->stg_id}}");
</script>
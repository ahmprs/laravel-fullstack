<?php
    // use App\Util as u;
?>

<div id="{{{$id}}}" class="mb-1 bg-blue round p-2">
    <button id="{{{$id}}}_btn_add" style="padding:5px;" class='btn high-light circle'>
        <img src="{{asset('img/plus.svg')}}" alt="ADD" style='width:45px;height:45px;'>
    </button>

    <div id="{{{$id}}}_div_menu_items" class="d-none dark round p-1 mb-1">
        <button id="{{{$id}}}_btn_new_div_doc" class="btn btn-primary">New Div Document</button>
    </div>
</div>

<script>
    CmpContentMenu.init("{{{$id}}}", "{{{$section}}}");
</script>
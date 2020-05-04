<div id="{{$id}}">
    <input id="{{$id}}_txt_x" type="number" placeholder="x = ?">
    <br>
    <input id="{{$id}}_txt_y" type="number" placeholder="x = ?">
    <br>
    <button id="{{$id}}_btn_add" class='btn btn-primary'>ADD</button>
    <br>
    <span id={{$id}}_spn_result>[RESULT]</span>
</div>
<script>
    CmpAdd.init("{{$id}}");
</script>
<div id="{{$id}}">
    <input id="{{$id}}_txt_x" type="number" placeholder="x = ?">
    <br>
    <input id="{{$id}}_txt_y" type="number" placeholder="x = ?">
    <br>
    <button owner="{{$id}}" class='btn btn-primary' onclick="CmpAdd.run(event);">ADD</button>
    <br>
    <span id={{$id}}_spn_result>[RESULT]</span>
</div>
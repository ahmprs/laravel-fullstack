<div id="{{$id}}">
    <input id="{{$id}}_txt_x" type="number" placeholder="x = ?">
    <br>
    <input id="{{$id}}_txt_y" type="number" placeholder="x = ?">
    <br>
    <button class='btn btn-primary' onclick="{{$id}}_add();">ADD</button>
    <br>
    <span id={{$id}}_spn_result>[RESULT]</span>
   
    <script>
        function {{$id}}_add(){
            // alert('ADDING');
            var x = parseFloat($('#{{$id}}_txt_x').val());
            var y = parseFloat($('#{{$id}}_txt_y').val());
            var z=x+y;
            $('#{{$id}}_spn_result').text(z);
        }
    </script>
</div>
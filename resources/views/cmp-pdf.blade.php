<div id="{{$id}}">
    <embed id='{{$id}}_emb_pdf' 
        src='{{$root_url}}/viewer/web/viewer.html?file={{$file_url}}' 
        type='text/html' 
        style='border: solid; border-color:rgb(77,77,77); border-width:5px; border-radius: 10px; width:100%; height:auto;'
    >
</div>
<script>
    CmpPdf.init("{{$id}}");
</script>
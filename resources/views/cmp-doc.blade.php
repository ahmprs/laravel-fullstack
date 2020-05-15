<?php
    use App\Calendar;
    use App\Util as u;

    $calendar = new Calendar();
    $doc_show = $rec->doc_show;
    $doc_tag = $rec->doc_tag;
    $content_editable='';
    if(u::userIsAdmin()) $content_editable='contenteditable';
?>

<div id="{{{$id}}}" 
    @if(u::userIsAdmin())
        class="border round dark p-2"
    @endif
>
    <div 
        id="{{{$id}}}_div_doc" 
        class="round p-2 mb-1 p-1" 
        @if(u::userIsAdmin())
        style="background-color: #eef; color:#123;"
        contenteditable
        @endif
        >
    </div>
    
        @if(u::userIsAdmin())
            <button id="{{{$id}}}_btn_menu" class="btn btn-secondary">...</button>
            <div id="{{{$id}}}_div_menu" class="d-none round light">
                <h3 class="round bg-blue center">Edit Meta</h3>
                <button id="{{{$id}}}_btn_hide_menu" class="btn btn-danger float-right mr-1 mt-1">&times;</button>

                <span>PUBLISH:</span>
                <select tag="{{{$doc_show}}}" id="{{{$id}}}_cmb_publish" class="btn btn-warning">
                    <option value="NO">NO</option>
                    <option value="YES">YES</option>
                </select>
                <br>

                <span>PUBLISH STARTS AT:</span>
                @component('cmp-calendar', ['id'=>"{$id}_doc_gdp_publish", 'calendar'=>$calendar, 'base_gdp'=>$rec->doc_gdp_publish])
                @endcomponent
                
                <span>PUBLISH EXPIRES AT:</span>
                @component('cmp-calendar', ['id'=>"{$id}_doc_gdp_expires", 'calendar'=>$calendar, 'base_gdp'=>$rec->doc_gdp_expires])
                @endcomponent

                <span>SECTION:</span>
                <select tag="{{{$doc_tag}}}" id="{{{$id}}}_cmb_section" class='btn btn-secondary'>
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
</div>
<script>
    CmpDoc.init("{{{$id}}}", "{{{$rec->doc_id}}}");
</script>
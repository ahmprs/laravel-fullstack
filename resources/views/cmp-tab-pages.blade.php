<div id="{{{$id}}}" class = 'm-0 p-0'>
   <div id="{{{$id}}}_div_buttons" class="bg-blue b-l b-r b-t round-top-left round-top-right">
        <?php
            for($i=0;$i<count($arr_buttons);$i++){
                $btn = $arr_buttons[$i];
                echo("<button pin='$i' class='btn'>$btn</button>");
            }
        ?>
    </div>

    <div id="{{{$id}}}_div_page_holder" class="p-1 b-l b-r b-b round-bottom-right round-bottom-left">
        @yield('pages')
    </div>



</div> 

<script>
    CmpTabPages.init("{{$id}}");
</script>
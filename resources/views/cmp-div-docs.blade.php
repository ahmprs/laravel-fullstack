<div id="{{{$id}}}">

<?php
    $cnt=0;
    foreach ($records as $rec)
    {
        ?>
        @component('cmp-doc',['id'=>"cmp_doc_".$id."_$cnt", 'rec'=>$rec, 'calendar'=>$calendar])

        @endcomponent
        <?php
        $cnt++;
    } 
?>
</div>
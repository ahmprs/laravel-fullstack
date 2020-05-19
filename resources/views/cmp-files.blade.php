<div id="{{{$id}}}">

<?php
    $cnt=0;
    foreach ($records as $f)
    {
        ?>
        @component('cmp-file',['id'=>"cmp_file_".$id."_$cnt", 'f'=>$f, 'calendar'=>$calendar])
        @endcomponent
        <?php
        $cnt++;
    } 
?>
</div>
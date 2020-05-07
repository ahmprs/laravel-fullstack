<div id="{{{$id}}}">

<?php
    // FILE NAME
    $k = 'Document File Name';
    $v = $f->file_org_name;
    $file_id = $f->file_id;

    echo('<div class="round light p-2">');
    

    echo("$k");
    echo ("<input class='form-control col-md-4' file_id='{$file_id}' id='{$id}_file_org_name' type='text' value='$v' readonly>");
    echo('<br>');

    // SHOW FILE (PUBLISH)
    $k = 'Publish Document (Show / Hide)';
    echo("$k");
    echo ("<select class='form-control col-md-4' s_indx='{$f->file_show}' file_id='{$file_id}' id='{$id}_file_show' class='round col-md-4 pl-0'><option>NO (Hide)</option><option>YES (Show)</option></select>");
    echo('<br>');


    // CREATE DATE (TIME OF UPLOAD)
    $k = 'Upload Date';
    echo("$k");
    ?>
    @component('cmp-calendar',['calendar'=>$calendar, 'base_gdp'=>$f->file_gdp_create])
        @slot('id')
            {{$id}}_file_gdp_create
        @endslot
    @endcomponent
    <?php
    echo('<br>');

    // START PUBLISH FROM
    $k = 'Start Publish Date';
    echo("$k");

    ?>
    @component('cmp-calendar',['calendar'=>$calendar, 'base_gdp'=>$f->file_gdp_publish])
        @slot('id')
            {{$id}}_file_gdp_publish
        @endslot
    @endcomponent
    <?php
    echo('<br>');

    // END PUBLISH
    $k = 'Stop Publish Date';
    echo("$k");
    ?>

    @component('cmp-calendar',['calendar'=>$calendar, 'base_gdp'=>$f->file_gdp_expires])
        @slot('id')
            {{$id}}_file_gdp_expires
        @endslot
    @endcomponent
    <?php
    echo('<br>');
    
    // SHOW SECTION == FILE TAG
    $k = 'Assign To';
    echo("$k");
    echo ("<select class='form-control col-md-4' s_txt='{$f->file_tag}' file_id='{$file_id}' id='{$id}_file_tag' class='round col-md-4 pl-0'><option>HOME</option><option>PRODUCTS</option><option>CONTACTS</option><option>CUSTOMER SERVICE</option><option>OFFERS</option></select>");
    echo('<br>');

    // EXTRA EMPTY ROW
    $v = "<button file_id='{$file_id}' id='{$id}_btn_remove' class='btn btn-warning'>REMOVE FILE</button>";
    $v .="<button file_id='{$file_id}' id='{$id}_btn_save' class='btn btn-primary ml-2'>SAVE CHANGES</button>";
    $v .="<button file_id='{$file_id}' id='{$id}_btn_view' class='btn btn-secondary ml-2'>VIEW FILE</button>";
    echo ("$v");

    echo('</div>');
    echo('<br>');
?>
</div>
<hr>
<script>
    CmpFile.init("{{$id}}");
</script>
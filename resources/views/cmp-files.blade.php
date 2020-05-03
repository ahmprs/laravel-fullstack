<div id="{{{$id}}}">
<style>
    input, span, select{
        margin-bottom:2px;
    }
</style>
<?php
    echo "<h4>$title</h4>";
    echo "<hr>";

    foreach ($records as $u)
    {
        echo ('<div class="row">');
        echo ('<div class="col-10">');
        echo ('<div class="row">');
        
        // FILE NAME
        $k = 'FILE NAME';
        $v = $u->file_org_name;
        echo ("<span class='col-4'>$k:</span>");
        echo ("<input class='round col-8' type='text' value='$v' readonly>");

        // SHOW FILE (PUBLISH)
        $k = 'SHOW';
        $v = $u->file_show;
        echo ("<span class='col-4'>$k:</span>");
        echo ("<select class='round col-8'><option>YES</option><option>NO</option></select>");

        // CREATE DATE (TIME OF UPLOAD)
        $k = 'CREATED';
        $gdp = (int)$u->file_gdp_create;
        $gdp_now = $calendar->getServerGdp();
        $jal = $calendar->gdpToJal($gdp);
        $diff_days = $gdp_now - $gdp + 1;
        
        echo ("<span class='col-4'>$k:</span>");
        echo ("<input class='center round col-4' type='text' value='$jal'>");
        echo ("<input class='center round col-2' type='number' value='$diff_days'>");
        echo ("<span class='center gray round col-2'>(days ago)</span>");


        // START PUBLISH FROM
        $k = 'PUBLISH';
        $gdp = (int)$u->file_gdp_create;
        $jal = $calendar->gdpToJal($gdp);
        $diff_days = $gdp_now - $gdp + 1;
        
        echo ("<span class='col-4'>$k:</span>");
        echo ("<input class='center round col-4' type='text' value='$jal'>");
        echo ("<input class='center round col-2' type='number' value='$diff_days'>");
        echo ("<span class='center gray round col-2'>(days ago)</span>");

        // END PUBLISH
        $k = 'EXPIRES AT';
        $gdp = (int)$u->file_gdp_expires;
        $jal = $calendar->gdpToJal($gdp);
        $diff_days = $gdp - $gdp_now + 1;
        
        echo ("<span class='col-4'>$k:</span>");
        echo ("<input class='center round col-4' type='text' value='$jal'>");
        echo ("<input class='center round col-2' type='number' value='$diff_days'>");
        echo ("<span class='center gray round col-2'>(days)</span>");

        
        // SHOW SECTION
        $k = 'SECTION';
        $v = $u->file_tag;
        echo ("<span class='col-4'>$k:</span>");
        echo ("<select class='round col-8'><option>HOME</option><option>PRODUCTS</option><option>CONTACTS</option><option>CUSTOMER SERVICE</option><option>OFFERS</option></select>");


        echo ("<span class='round col-6'>ACTIONS:</span>");
        echo ("<button class='btn btn-success col-2'>VIEW</button>");
        echo ("<button class='btn btn-primary col-2'>UPDATE</button>");
        echo ("<button class='btn btn-danger col-2'>DELETE</button>");


        echo ('</div>');
        echo ('</div>');
        echo ('</div>');
        echo ('<hr>');
    }    
?>
</div>
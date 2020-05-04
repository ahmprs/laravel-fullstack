<div id="{{$id}}">
    <!-- Modal -->
    <div class="modal fade" 
        id="{{$id}}_div_modal" 
        tabindex="-1" 
        role="dialog" 
        aria-labelledby="{{$id}}_div_modal_title" 
        aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="{{$id}}_div_modal_title">PICK DATE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div>
            <button class="float-right mt-1 mr-1" id="{{$id}}_btn_next_month">NEXT</button>
            <button class="mt-1 ml-1" id="{{$id}}_btn_prev_month">PREV</button>
            <hr>
        </div>
        <div class="modal-body">
            <table id="{{$id}}_tbl_calendar" style="margin-left:auto; margin-right:auto;">
                <tr>
                    <th class='center'>0</th>
                    <th class='center'>1</th>
                    <th class='center'>2</th>
                    <th class='center'>3</th>
                    <th class='center'>4</th>
                    <th class='center'>5</th>
                    <th class='center'>6</th>
                </tr>
            <?php
                $gdp = $base_gdp;
                $c = $calendar->getNew();
                $c->setGdp($gdp);
                $arr = $c->gdpToJalDateTimeInfoArr();
                
                $jy=$arr['jalYear'];
                $jm=$arr['jalMonth'];
                $jd=$arr['jalDayOfMonth'];
                
                $gdp = $gdp - $jd + 1;
                $c->setGdp($gdp);
                $arr = $c->gdpToJalDateTimeInfoArr();
                $brr = $c->gdpToGregDateTimeInfoArr();
                $jdw = $arr['jalDayOfWeek'];

                $n = $arr['daysInMonth'];

                $pre = $jdw;
                $post = $jdw + $n;
                $indx = 0;
                
                $j = 0;
                $g = 0;
                $jal='';
                $greg='';
                for($i=0;$i<7;$i++)
                {
                    echo('<tr>');
                    for($k=0;$k<7;$k++){
                        if ($pre<=$indx&&$indx<$post) {
                            $j++;
                            $g = $c->getGregDayOfMonth();
                            $jal = $c->getJalDate();
                            $greg = $c->getGregDate();
                            $gdp++;
                            $c->setGdp($gdp);
                        }

                        echo('<td>');
                        $display = ($indx<$pre||$indx>=$post)? 'd-none':'';
                        echo("<button id='{$id}_btn_$indx' class='btn btn-primary $display' style='width:100%' gdp='$gdp' jal='$jal' greg='$greg'>$j<sub gdp='$gdp' jal='$jal' greg='$greg'>$g</sub></button>");
                        echo('</td>');
                        $indx++;
                    }
                }
            ?>
            </table>
        </div>

        <div class="modal-footer">
            <button id="{{$id}}_btn_cancel" type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button id="{{$id}}_btn_ok" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
        </div>
    </div>
    </div>     

    <input 
        type="text" 
        id="{{$id}}_txt_date" 
        placeholder="DATE" 
        data-toggle="modal" 
        data-target="#{{$id}}_div_modal"
        readonly
    >

    <script>
        CmpCalendar.init("{{$id}}");
    </script>
</div>
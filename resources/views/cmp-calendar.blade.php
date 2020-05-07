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
        <div id="{{$id}}_div_brief" class="round dark mono m-1 p-1">
            <h4 id="{{$id}}_h4_greg_date" class="d-inline">GREG</h4>
            <h4 id="{{$id}}_h4_jal_date" class="d-inline float-right">JAL</h4>
        </div>

        <h4 id="{{$id}}_h3_jal_date_str" class="center round dark p-2 m-1" style="direction:rtl;"></h4>
        <h4 id="{{$id}}_h3_greg_date_str" class="center round dark p-2 m-1" ></h4>

        <div class="round dark p-2 m-1">
            <button class="btn btn-secondary float-right" id="{{$id}}_btn_next_month">NEXT ►</button>
            <button class="btn btn-secondary" id="{{$id}}_btn_prev_month">◄ PREV</button>
        </div>
        <div class="modal-body">
            <table id="{{$id}}_tbl_calendar" style="margin-left:auto; margin-right:auto;">
                <tr>
                    <th class='center dark round m-1'>ش</th>
                    <th class='center dark round m-1'>ی</th>
                    <th class='center dark round m-1'>د</th>
                    <th class='center dark round m-1'>س</th>
                    <th class='center dark round m-1'>چ</th>
                    <th class='center dark round m-1'>پ</th>
                    <th class='center dark round m-1'>ج</th>
                </tr>
            <?php
                $server_gdp=(int)$calendar->getServerGdp();
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
                        
                        echo("<button id='{$id}_btn_$indx' class='btn btn-primary' style='width:100%; padding:2px; font-size:1.1em;'><span></span><span style='float:right; font-size:0.6em; padding:2px;'></span><span style='float:right; background-color:rgb(246, 217, 154); color:#135; border-radius:5px; font-size:0.5em;padding:2px;'></span></button>");
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

    <div class="input-group col-md-6" style="padding-left:0px;">
        <div class="input-group-prepend">
            <button 
                id="{{$id}}_btn_change" 
                class="input-group-text m-0"
                data-toggle="modal" 
                data-target="#{{$id}}_div_modal"
                >...
            </button>
        </div>
        <input 
            type="text" 
            class="form-control col-md-7"
            id="{{$id}}_txt_date" 
            placeholder="DATE" 
            readonly
            server_gdp="{{$server_gdp}}"
            gdp="{{$base_gdp}}"
        >
    </div>

    <script>
        CmpCalendar.init("{{$id}}");
    </script>
</div>
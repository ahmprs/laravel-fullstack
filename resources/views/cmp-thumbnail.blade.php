<div id="{{$id}}" style="display: inline-block; margin: 2px; border-radius: 5px; border-width:1px; border: solid; border-color: #444;">
    <style>
        .{{$id}}-img-th{
            width: 300px;
            height: 200px; 
            margin-top: 0px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            opacity: 0.7;
            cursor: pointer;
            -webkit-transition: opacity 1s ease-in-out;
            -moz-transition: opacity 1s ease-in-out;
            -ms-transition: opacity 1s ease-in-out;
            -o-transition: opacity 1s ease-in-out;
            transition: opacity 1s ease-in-out;
        }

        .{{$id}}-img-th:hover{
            filter: alpha(opacity=50);
            opacity: 1.0;
        }

        .{{$id}}-title{
            text-align: center;
            font-style: italic;
            font-family: 'Times New Roman';
            padding:5px;
            background-image: linear-gradient(
                to bottom,
                #012,
                #789
            );
            color: #def;
            margin-bottom: 0px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

    </style>

    <div id="{{$id}}_div_thumbnail" style="position:relative">
        <h3 class="{{$id}}-title" id="{{$id}}_h3_title">{{$title}}</h3>
        <img class="{{$id}}-img-th" id="{{$id}}_img_pic" src="{{$img_src}}" alt="{{$img_alt}}">

        <div id="{{$id}}_div_splash">
            <?php 
                if(isset($arr_splash)){
                    for($i=0;$i<count($arr_splash);$i++){
                        $sp = $arr_splash[$i];
                        echo "<span class='d-none' style='position:absolute; left:5px; bottom:5px; right:5px; color: lime; font-size: 20px; background-color: #111; opacity: 0.7;'>$sp</span>";
                    }
                }
            ?>
        </div>
    </div>

    <script>
        CmpThumbNail.init("{{$id}}");
    </script>
</div>
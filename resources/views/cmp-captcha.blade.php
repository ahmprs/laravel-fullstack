
<div id="{{$id}}" class="input-group mt-2">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <button class="btn btn-warning" onclick="{{$id}}_refresh();">
                <svg class="bi bi-arrow-clockwise" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.17 6.706a5 5 0 017.103-3.16.5.5 0 10.454-.892A6 6 0 1013.455 5.5a.5.5 0 00-.91.417 5 5 0 11-9.375.789z" clip-rule="evenodd"></path>
                <path fill-rule="evenodd" d="M8.147.146a.5.5 0 01.707 0l2.5 2.5a.5.5 0 010 .708l-2.5 2.5a.5.5 0 11-.707-.708L10.293 3 8.147.854a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                </svg>                
            </button>
        </div>
    </div>

    <img id="{{$id}}_img_captcha" class="captcha" src="{{$root_url}}/captcha" alt="CAPTCHA-IMAGE">

    <div class="input-group-append">
        <div class="input-group-text">
            <input class="p-2" type="number" id="{{$id}}_txt_captcha" placeholder=" → THE NUMBER">
        </div>
    </div>
</div>

<script>
    function {{$id}}_refresh(){
        var img = document.getElementById("{{$id}}_img_captcha");
        img.src =  root_url + "/captcha";
    }    
</script>
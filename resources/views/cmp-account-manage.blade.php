<?php
    use App\Util as u;
    $user_id = session()->get('user_id','');
    $user_name = session()->get('user_name','');
    $user_email = session()->get('user_email','');
    $user_access_level = session()->get('user_access_level','');
    $user_active = session()->get('user_active','');
    $ua = $user_active==1? "YES":"NO";
    $user_is_admin = u::userIsAdmin();
?>

@if($user_id=='')

@else
    <div id="{{{$id}}}" class="round light p-2">
        <h3 class="dark round center">USER INFO</h3>
        <span>USER ID:</span>
        <input type="text" value="{{{$user_id}}}" class="form-control col-md-4" readonly>
        
        <span>USER NAME:</span>
        <input id="{{{$id}}}_txt_user_name" type="text" value="{{{$user_name}}}" class="form-control col-md-4" readonly>
        
        <span>USER EMAIL:</span>
        <input type="text" id="{{{$id}}}_txt_user_email" value="{{{$user_email}}}" class="form-control col-md-4">
        <button id="{{{$id}}}_btn_update_email" class="btn btn-primary mt-1">UPDATE EMAIL ADDRESS</button>
        <br>
        <hr>

        <span>USER ACCESS LEVEL:</span>
        <input type="text" value="{{{$user_access_level}}}" class="form-control col-md-4" readonly>

        <span>USER ACTIVE:</span>
        <input type="text" value="{{{$ua}}}" class="form-control col-md-4" readonly> 
        <br>
        <hr>
        
        <button id="{{{$id}}}_btn_show_change_password" class="btn btn-warning mt-1">MANAGE PASSWORD</button>
        <div id="{{{$id}}}_div_change_password" class="d-none">
            <span>CURRENT PASSWORD:</span>
            <input id="{{{$id}}}_txt_psw_current" type="password" value="" class="form-control col-md-4" placeholder="CURRENT PASSWORD">

            <span>NEW PASSWORD:</span>
            <input id="{{{$id}}}_txt_psw_new" type="password" value="" class="form-control col-md-4" placeholder="NEW PASSWORD">

            <span>RE-TYPE NEW PASSWORD:</span>
            <input id="{{{$id}}}_txt_psw_confirm" type="password" value="" class="form-control col-md-4" placeholder="RE-TYPE PASSWORD">

            <button id="{{{$id}}}_btn_change_password" class="btn btn-primary mt-1">CHANGE PASSWORD</button>
        </div>
    </div>
    <script>
        CmpAccountManage.init("{{{$id}}}", "{{{$user_id}}}");
    </script>
@endif
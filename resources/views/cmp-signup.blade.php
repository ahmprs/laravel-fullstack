<div id="{{$id}}">

    <input id="{{$id}}_txt_user_name" type="text" placeholder="USER NAME">
    <br>
    <input id="{{$id}}_txt_user_pass" type="password" placeholder="PASSWORD">
    <br>
    <input id="{{$id}}_txt_user_pass_cnf" type="password" placeholder="CONFIRM PASSWORD">
    <br>
    <input id="{{$id}}_txt_user_email" type="email" placeholder="USER EMAIL">
    <br>
    <button class='btn btn-primary' onclick="{{$id}}_signup();">SIGN-UP</button>
    <br>
    <span id={{$id}}_spn_result></span>

    <script>
        function {{$id}}_signup(){
            // alert('ADDING');
            var user_name = $('#{{$id}}_txt_user_name').val();
            var user_pass = $('#{{$id}}_txt_user_pass').val();
            var user_pass_cnf = $('#{{$id}}_txt_user_pass_cnf').val();
            var user_email = $('#{{$id}}_txt_user_email').val();

            if(user_name.trim()==''){
                alert('missing user name');
                return;
            }

            if(user_pass.trim()==''){
                alert('missing user password');
                return;
            }
            
            if(user_pass!=user_pass_cnf){
                alert('password mismatch');
                return;
            }

            if(user_email.trim()==''){
                alert('missing user email');
                return;
            }

            var user_pass_hash=getMd5(user_pass);

            $.post(
                './api/sign-up',
                {user_name, user_pass_hash, user_email},
                (d,s)=>{
                    console.log(d);
                }
            );

            // console.log({user_name, user_pass,user_pass_hash, user_pass_cnf, user_email});

            // $('#{{$id}}_spn_result').text(z);
        }
    </script>
</div>
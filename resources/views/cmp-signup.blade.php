<div id="{{$id}}">
    <style>
        .{{$id}}_inp {
            background-image: linear-gradient(
                to right,
                rgb(245, 242, 209),
                #c2e6b9
            );
        }

        .{{$id}}_svg{
            background-color:#123;
            color:#abcdef;
            border:solid;
            border-width:1px;
            border-radius:5px 20px;
        }
    </style>

    <!-- USER NAME -->
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text {{$id}}_svg">
                <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <input class="{{$id}}_inp form-control" id="{{$id}}_txt_user_name" type="text" placeholder="USER NAME" />
    </div>

    <!-- USER PASSWORD -->
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text {{$id}}_svg">
                <svg class="bi bi-lock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 00-1 1v5a1 1 0 001 1h7a1 1 0 001-1V9a1 1 0 00-1-1zm-7-1a2 2 0 00-2 2v5a2 2 0 002 2h7a2 2 0 002-2V9a2 2 0 00-2-2h-7zm0-3a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <input class="{{$id}}_inp form-control" id="{{$id}}_txt_user_pass" type="password" placeholder="PASSWORD" />
    </div>

    <!-- CONFIRM PASSWORD -->
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text {{$id}}_svg">
                <svg class="bi bi-check-all" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.354 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                    <path d="M6.25 8.043l-.896-.897a.5.5 0 10-.708.708l.897.896.707-.707zm1 2.414l.896.897a.5.5 0 00.708 0l7-7a.5.5 0 00-.708-.708L8.5 10.293l-.543-.543-.707.707z"></path>
                </svg>
            </div>
        </div>
        <input class="{{$id}}_inp form-control"
        id="{{$id}}_txt_user_pass_cnf"
        type="password"
        placeholder="CONFIRM PASSWORD"/>
    </div>

    <!-- USER EMAIL -->
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text {{$id}}_svg">@</div>
        </div>
        <input class="{{$id}}_inp form-control" id="{{$id}}_txt_user_email" type="email" placeholder="USER EMAIL" />
    </div>

    @component('cmp-captcha')
        @slot('id')
            cmp_captcha
        @endslot
    @endcomponent


    <br />
    <button class="btn btn-primary" onclick="{{$id}}_signup();">SIGN-UP</button>
    <br />
    <span id="{{$id}}_spn_result"></span>


    <!-- <form>
        <div class="form-row align-items-center">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
            </div>
        </div>
    </form> -->

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

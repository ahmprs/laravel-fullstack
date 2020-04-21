<h4 id="{{$id}}_div_err" class="d-none alert alert-danger"></h4>

@if(Session::get('user_id','')!='')
<div id="{{$id}}">
    <div class="center m-4">
        <h3>Welcome dear <em>{{Session::get('user_name','')}}</em>, you are now signed in</h3>
        <button class="btn btn-warning" onclick="{{$id}}_sign_out();">
            SIGN OUT
            <img src="{{asset('img/log-out-icon.svg')}}" alt="SIGN-OUT">            
        </button>
    </div>

    <script>
        function {{$id}}_sign_out(){
            $.post(
                root_url + '/api/log-out',
                {},
                function(d,s){
                    console.log({d,s});
                    if(d['ok']==1){
                        document.location.href= root_url + "/sign-in";
                    }
                }
            );
        }
    </script>
</div>

@else
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
    <div class="input-group col-md-4">
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
    <div class="input-group col-md-4">
        <div class="input-group-prepend">
            <div class="input-group-text {{$id}}_svg">
                <svg class="bi bi-lock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 00-1 1v5a1 1 0 001 1h7a1 1 0 001-1V9a1 1 0 00-1-1zm-7-1a2 2 0 00-2 2v5a2 2 0 002 2h7a2 2 0 002-2V9a2 2 0 00-2-2h-7zm0-3a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <input class="{{$id}}_inp form-control" id="{{$id}}_txt_user_pass" type="password" placeholder="PASSWORD" />
    </div>

    @component('cmp-captcha')
        @slot('id')
            cmp_captcha
        @endslot
        @slot('root_url')
            {{$root_url}}
        @endslot
    @endcomponent

    <br />
    <button class="btn btn-primary" onclick="{{$id}}_sign_in();">SIGN-IN</button>
    <br />
    <span id="{{$id}}_spn_result"></span>

    <script>
        function {{$id}}_sign_in(){
            
            // alert('ADDING');
            var user_name = $('#{{$id}}_txt_user_name').val();
            var user_pass = $('#{{$id}}_txt_user_pass').val();

            if(user_name.trim()==''){
                alert('missing user name');
                return;
            }

            if(user_pass.trim()==''){
                alert('missing user password');
                return;
            }

            var user_pass_hash=getMd5(user_pass);
            var txt_captcha = $("#cmp_captcha_txt_captcha").val();
            var login_token='';
            var digest = "";

            $.post(
                root_url + '/api/get-login-token',
                {},
                function(d,s){
                    login_token = d['result'];
                    digest=getMd5(user_pass_hash + login_token);
                   
                    $.post(
                        root_url + '/api/sign-in',
                        {user_name, digest, txt_captcha},
                        (dd,ss)=>{
                            console.log(dd);
                            
                            if(dd['ok']==1){
                                console.log(dd);
                                document.location.href=root_url + "/sign-in";
                            }
                            else {
                                debugger;
                                var div_err = $('#{{$id}}_div_err');
                                div_err.html('');
                                div_err.hide();
                                div_err.removeClass('d-none');
                                div_err.append($('<strong>Login Failed</strong>'));
                                div_err.append($('<br />'));
                                div_err.append($('<p></p>').text(dd['result']['err'] || ''));
                                div_err.fadeIn();
                            }

                        }
                    );
                }
            );

        }
    </script>
</div>
@endif
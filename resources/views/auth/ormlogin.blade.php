@extends('layouts.ormApp')

@push('styles')
    <!-- Styles -->
    <link href="{{ asset('css/orm-login-style.css') }}" rel="stylesheet">



    <!-- Clear All Input After Closing The Modal -->
    <script>
        $('#btn-register').on('click', function () {
            $('#signupModal form')[0].reset();
            $('.password-rules p').css('color', '#ff0000');
        });

        $('#signupModal'). on('hidden.bs.modal', function () {
            $('#signupModal form')[0].reset();
            $("#signupModal #s2, #signupModal #s3").css("color", "#000000");
            $("#signupModal #process").css("width", "120px");
            $("#signupModal #form2, #signupModal #form3").css("left", "500px");
            $("#signupModal #form1").css("left", "0px");
        });
    </script>

    <!-- Show Password in Registration Modal -->
    <script>
        $(document).ready(function(){
            $('#show-pass').on('click', function() {
                event.preventDefault();
                if($('#password').attr("type") == "text"){
                    $('#password').attr('type', 'password');
                    $('#show-pass i').addClass( "fa-eye-slash" );
                    $('#show-pass i').removeClass( "fa-eye" );
                }else if($('#password').attr("type") == "password"){
                    $('#password').attr('type', 'text');
                    $('#show-pass i').removeClass( "fa-eye-slash" );
                    $('#show-pass i').addClass( "fa-eye" );
                }
            })

            $('#show-confirm-pass').on('click', function() {
                event.preventDefault();
                if($('#confirm_password').attr("type") == "text"){
                    $('#confirm_password').attr('type', 'password');
                    $('#show-confirm-pass i').addClass( "fa-eye-slash" );
                    $('#show-confirm-pass i').removeClass( "fa-eye" );
                }else if($('#confirm_password').attr("type") == "password"){
                    $('#confirm_password').attr('type', 'text');
                    $('#show-confirm-pass i').removeClass( "fa-eye-slash" );
                    $('#show-confirm-pass i').addClass( "fa-eye" );
                }
            })

            $('#login-pass-show').on('click', function() {
                event.preventDefault();
                if($('.form-section #password').attr("type") == "text"){
                    $('.form-section #password').attr('type', 'password');
                    $('#login-pass-show i').addClass( "fa-eye-slash" );
                    $('#login-pass-show i').removeClass( "fa-eye" );
                }else if($('.form-section #password').attr("type") == "password"){
                    $('.form-section #password').attr('type', 'text');
                    $('#login-pass-show i').removeClass( "fa-eye-slash" );
                    $('#login-pass-show i').addClass( "fa-eye" );
                }
            })
        });
    </script>

    <!-- Check if Middle Name InputBox is empty -->
    <script>
        $('#up-submit').on('click', function() {
            if($('#mname').val() == ""){
                $('#mname').val("-");
            }
        });
    </script>
    
    <!-- Modal Function Buttons -->
    <script>
        $(document).ready(function(){
            $('#pi-next').click(function(){
                $('#form1').css("left", "-1000px");
                $('#form2').css("left", "0px");
                $('#process').css("width", "240px");
                $('#s2').css("color", "#ffffff");
                $('#role').val('Owner');
                $('.in-role').addClass("d-none")
            });

            $('#ai-back').click(function(){
                $('#form1').css("left", "0px");
                $('#form2').css("left", "500px");
                $('#process').css("width", "120px");
                $('#s2').css("color", "#000000");
            });

            $('#ai-next').click(function(){
                $('#form2').css("left", "-1000px");
                $('#form3').css("left", "0px");
                $('#process').css({"width": "100%", "content":"none"});
                $('#s3').css("color", "#ffffff");
            });

            $('#up-back').click(function(){
                $('#form2').css("left", "0px");
                $('#form3').css("left", "500px");
                $('#process').css({"width": "240", "content":""});
                $('#s3').css("color", "#000000");
            });
        })
    </script>
    
@endpush

@section('content')
    <section class="container d-flex justify-content-center login-section mt-5">
        <div class="col-md-4 logo-section d-flex justify-content-center align-items-center">
        <!-- @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif -->
            <div class="content">
                <div class="img-logo d-flex justify-content-center">
                    <img src="{{ asset('images/logo2.png') }}" alt="">
                </div>
                <div class="title h1 text-center">Online Waste Recycling Management System</div>
                <input type="text" name="" id="chUserTbl" value="{{$checkUsertbl}}" hidden>
            </div>

            @include('auth.ormRegistration')
        </div>

        <!-- Sign In Section -->
        <div class="col-md-8 form-section d-flex justify-content-center align-items-center">
            <div class="content col-6">
                <div class="form-title h2">Sign In to your Account</div>
                <form method="post" action="custom-login">
                    @csrf
                    <div class="inner-form d-flex">
                        <span class="login-icon d-flex align-items-center justify-content-center"><em class="fa fa-envelope-o"></em></span>
                        <input class="form-input" type="email" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="inner-form d-flex">
                        <span class="login-icon d-flex align-items-center justify-content-center"><em class="fa fa-lock"></em></span>
                        <input class="form-input" type="password" id="password" name="password" placeholder="Password" required>
                        <span class="show_li_password d-flex align-items-center justify-content-end" id="login-pass-show"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                    </div>

                    <div class="fp"><a href="/forgot-password">Forgot Password?</a></div>
                    
                    <button type="submit" class="btn btn-signin">SIGN IN</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        $(window).on("load",function(){
            if($('#chUserTbl').val() == "no user"){
                $('#signupModal').modal("show");
                $('#parent_page').val("Login Page");
            }
        });
    </script>

    <!-- Check if the Inputs is Empty Before Next Step -->
    <script>
        var pass_contain = false;
        var uppercase = false;
        var lowercase = false;
        var digits = false;
        var characters = false;
        var length = false;

        var confirm_password = false;
        $('#password').on("keyup", function(){
            // check if Uppercase Letter existed in Password
            if (/[A-Z]+/.test($("#password").val())) {
                $('#capital').css("color", "#00ff00");
                uppercase = true;
            } else{
                $('#capital').css("color", '#ff0000');
                uppercase = false;
            }
            // check if Lowercase Letter existed in Password
            if (/[a-z]+/.test($("#password").val())) {
                $('#letter').css("color", "#00ff00");
                lowercase = true;
            } else{
                $('#letter').css("color", '#ff0000');
                lowercase = false;
            }
            // check if Digits existed in Password
            if (/[0-9]+/.test($("#password").val())) {
                $('#number').css("color", "#00ff00");
                digits = true;
            } else{
                $('#number').css("color", '#ff0000');
                digits = false;
            }
            // check if Character existed in Password
            if (/[^a-zA-Z0-9]+/.test($("#password").val())) {
                $('#char').css("color", "#00ff00");
                characters = true;
            } else{
                $('#char').css("color", '#ff0000');
                characters = false;
            }
            // check if Character existed in Password
            if ($('#password').val().length >= 8 ){
                $('#length').css("color", "#00ff00");
                length = true;
            } else{
                $('#length').css("color", '#ff0000');
                length = false;
            }

            if ((uppercase == true) && (lowercase == true) && (digits == true) && (characters == true) && (length == true)) {
                $("#password").css('border-color', "#00ff00");
                pass_contain = true;
            } else{
                $("#password").css('border-color', '#ff0000');
                pass_contain = false;
            }
        });

        $('#password').mouseleave(function(){ $(this).css('border-color', '#52bffd')});

        $('#confirm_password').keyup(function(){
            if ($('#confirm_password :password').val() == $('#password :password').val()){
                $("#confirm_password").css('border-color', "#00ff00");
                confirm_password = true;
            } else {
                $("#confirm_password").css('border-color', '#ff0000');
                confirm_password = false;
            }
            
        });
        
        $(document).ready(function(){
            $("#pi-next").prop("disabled", true);
            $("#ai-next").prop("disabled", true);

            $('#btn-register').on('click', function(){
                $("#pi-next").prop("disabled", true);
                $("#ai-next").prop("disabled", true);
            });
            
            // #form1 checking Inputs
            $("#form1 input, #form1 select").each(function(){
                $(this).on('change', function(){
                    if(($('#fname').val() != "") && ($('#lname').val() != "") && ($('#gender :selected').val() != "Choose Gender")){
                        $("#pi-next").removeAttr('disabled');
                    }else{
                        $("#pi-next").prop("disabled", true);
                    }
                });
                
            });

            // #form2 checking Inputs
            $("#form2 input, #form2 select").each(function(){
                $(this).keyup(function(){
                    if(($('#role :selected').val() != "Choose Role") && ($('#email').val() != "") && ($('#password').val() != "") && ($('#confirm_password').val() != "") && (pass_contain == true)){
                        $("#ai-next").removeAttr('disabled');
                    }else{
                        $("#ai-next").prop("disabled", true);
                    }
                });
                
            });
        });
    </script>
@endsection

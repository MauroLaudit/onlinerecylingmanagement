@extends('layouts.ormApp')

@push('styles')
    <!-- Styles -->
    <link href="{{ asset('css/orm-login-style.css') }}" rel="stylesheet">

    <!-- Clear All Input After Closing The Modal -->
    <script>
        $('#signupModal'). on('hidden.bs.modal', function () {
            $('#signupModal form')[0]. reset();
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

    <!-- Check if the Inputs is Empty Before Next Step -->
    <script>
        $(document).ready(function(){
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
                    if(($('#role :selected').val() != "Choose Role") && ($('#email').val() != "") && ($('#password').val() != "") && ($('#confirm_password').val() != "")){
                        $("#ai-next").removeAttr('disabled');
                    }else{
                        $("#ai-next").prop("disabled", true);
                    }
                });
                
            });
        })
    </script>
    
    <!-- Modal Function Buttons -->
    <script>
        var f1 = document.getElementById("form1");
        var f2 = document.getElementById("form2");
        var f3 = document.getElementById("form3");

        var nxt1 = document.getElementById("pi-next");
        var bck1 = document.getElementById("ai-back");
        var nxt2 = document.getElementById("ai-next");
        var bck2 = document.getElementById("up-back");

        var s2 = document.getElementById("s2"); 
        var s3 = document.getElementById("s3"); 
        var sc = document.getElementById("process"); 

        nxt1.onclick = function(){
            f1.style.left = "-1000px";
            f2.style.left = "0px";
            sc.style.width = "240px";
            s2.style.color = "#ffffff"; 
        }

        bck1.onclick = function(){
            f1.style.left = "0px";
            f2.style.left = "500px";
            sc.style.width = "120px";
            s2.style.color = "#000000"; 
        }

        nxt2.onclick = function(){
            f2.style.left = "-1000px";
            f3.style.left = "0px";
            sc.style.width = "100%";
            sc.style.content = "none";
            s3.style.color = "#ffffff"; 
        }

        bck2.onclick = function(){
            f2.style.left = "0px";
            f3.style.left = "500px";
            sc.style.width = "240px";
            sc.style.content = "";
            s3.style.color = "#000000"; 
        }
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
                <div class="text-button d-flex justify-content-center align-items-end">
                    <div id="btn-register" type="button" class="btn btn-signup" data-bs-toggle="modal" data-bs-target="#signupModal">SIGN UP</div>
                </div>
            </div>

            @include('auth.ormRegistration')
        </div>

        <!-- Sign In Section -->
        <div class="col-md-8 form-section d-flex justify-content-center align-items-center">
            <div class="content">
                <div class="form-title h2 ">Sign In to your Account</div>
                <form method="POST" action="">
                    <div class="form-group d-flex">
                        <span class="d-flex align-items-center justify-content-center"><em class="fa fa-envelope-o"></em></span>
                        <input type="email" class="form-input" id="siEmail" name="email" aria-describedby="emailSignUp" placeholder="Email">
                    </div>
                    <div class="form-group d-flex">
                        <span class="d-flex align-items-center justify-content-center"><em class="fa fa-lock"></em></span>
                        <input type="password" class="form-input" id="siPassword" name="password" placeholder="Password">
                    </div>

                    <div class="fp"><a href="/forgot-password">Forgot Password?</a></div>
                    
                    <button type="submit" class="btn btn-signin">SIGN IN</button>
                </form>
            </div>
        </div>
    </section>

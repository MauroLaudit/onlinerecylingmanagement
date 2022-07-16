@extends('layouts.ormApp')


@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-manageuser-style.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="head-title sticky-top">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="title">
                        <h1>Manage Users</h1>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <div type="button" class="btn-nav d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#signupModal" id="add-btn-order">
                        <em class="fa fa-user-plus" aria-hidden="true"></em> Add User
                    </div>
                </div>
            </div>  
        </div>
    </section>
    @include('auth.ormRegistration')

    <section class="usermanage-section my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="manageUserTable" class="table table-striped table-hover table-bordered pt-3" data-page-length='50'>
                        <thead>
                            <tr>
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @if($user)
                            @foreach($user as $userList)
                            <tr>
                                <td data-label="profile_picture" scope="row">
                                <img class="image rounded" src="images/{{$userList->upload_img}}" alt="profile_image" style="width: 55px;height: 55px; padding: 5px; margin: 0px; ">
                                </td>
                                <td data-label="user_name">
                                    {{ $userList->lname }}, {{ $userList->fname }} 
                                    @if( $userList->mname  != '-')
                                        <span>{{ $userList->mname }}</span>
                                    @endif
                                    
                                </td>
                                <td data-label="user_email">{{ $userList->email }}</td>
                                <td data-label="user_role">{{ $userList->role }}</td>
                                <!-- <td class="">
                                    <div type="button" class="btn-inner">
                                        <a data-bs-toggle="modal" type="button" data-bs-target="#" class="text-nav btn-view d-flex align-items-center justify-content-center text-decoration-none btn_viewOrders">
                                            <em class="fa fa-pencil" aria-hidden="true"></em>View Orders
                                        </a>
                                    </div>
                                </td> -->
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </section>



    <!-- // ----SCRIPT SECTION---- // -->
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

    <!-- Check if the Inputs is Empty Before Next Step -->
    <script>
        var pass_contain = false;
        var uppercase = false;
        var lowercase = false;
        var digits = false;
        var characters = false;
        var length = false;
        var pass_strength = 0;

        var confirm_password = false;
        $('#password').keyup(function(){
            // check if Uppercase Letter existed in Password
            if (/[A-Z]+/.test($("#password").val())) {
                $('#capital').css('color', '#00ff00');
                uppercase = true;
                pass_strength+=1;
            } else{
                $('#capital').css('color', '#ff0000');
                uppercase = false;
                pass_strength-=1;
            }
            // check if Lowercase Letter existed in Password
            if (/[a-z]+/.test($("#password").val())) {
                $('#letter').css('color', '#00ff00');
                lowercase = true;
                pass_strength+=1;
            } else{
                $('#letter').css('color', '#ff0000');
                pass_strength-=1;
                lowercase = false;
            }
            // check if Digits existed in Password
            if (/[0-9]+/.test($("#password").val())) {
                $('#number').css('color', '#00ff00');
                digits = true;
                pass_strength+=1;
            } else{
                $('#number').css('color', '#ff0000');
                pass_strength-=1;
                digits = false;
            }
            // check if Character existed in Password
            if (/[^a-zA-Z0-9]+/.test($("#password").val())) {
                $('#char').css('color', '#00ff00');
                characters = true;
                pass_strength+=1;
            } else{
                $('#char').css('color', '#ff0000');
                characters = false;
                pass_strength-=1;
            }
            // check if Character existed in Password
            if ($('#password').val().length >= 8 ){
                $('#length').css('color', '#00ff00');
                length = true;
                pass_strength+=1;
            } else{
                $('#length').css('color', '#ff0000');
                length = false;
                pass_strength-=1;
            }

            if ((uppercase == true) && (lowercase == true) && (digits == true) && (characters == true) && (length == true)) {
                $("#password").css('border-color', '#00ff00');
                pass_contain = true;
            } else{
                $("#password").css('border-color', '#ff0000');
                pass_contain = false;
            }
        });

        $('#password').mouseleave(function(){ $(this).css('border-color', '#52bffd')});

        $('#confirm_password').keyup(function(){
            if ($('#confirm_password :password').val() == $('#password :password').val()){
                $("#confirm_password").css('border-color', '#00ff00');
                confirm_password = true;
            } else {
                $("#confirm_password").css('border-color', '#ff0000');
                confirm_password = false;
            }
            
        });
        
        $(document).ready(function(){
            $('#add-btn-order').on('click', function(){
                $("#pi-next").prop("disabled", true);
                $("#ai-next").prop("disabled", true);
                $('#parent_page').val("User Management Page");
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
@endsection
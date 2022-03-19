@extends('layouts.ormApp')

@push('styles')
    <!-- Styles -->
    <link href="{{ asset('css/orm-login-style.css') }}" rel="stylesheet">

    <script>
        $('#signupModal'). on('hidden.bs.modal', function () {
            $('#signupModal form')[0]. reset();
            $("#signupModal #s2, #signupModal #s3").css("color", "#000000");
            $("#signupModal #process").css("width", "120px");
            $("#signupModal #form2, #signupModal #form3").css("left", "500px");
            $("#signupModal #form1").css("left", "0px");
        });
    </script>

    <script>
        const input = document.getElementById('imageUpload')
            input.addEventListener('change', (event) => {
            const target = event.target
                if (target.files && target.files[0]) {

                /*Maximum allowed size in bytes
                    5MB Example
                    Change first operand(multiplier) for your needs*/
                const maxAllowedSize = 1 * 1024 * 1024;
                if (target.files[0].size > maxAllowedSize) {
                    // Here you can ask your users to load correct file
                    target.value = ''
                }
            }
        })
    </script>
    
    <!-- Scripts -->
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
        <div class="content">
            <div class="img-logo d-flex justify-content-center">
                <img src="{{ asset('images/logo2.png') }}" alt="">
            </div>
            <div class="title h1 text-center">Online Waste Recycling Management System</div>
            <div class="text-button d-flex justify-content-center align-items-end">
                <div type="button" class="btn btn-signup" data-bs-toggle="modal" data-bs-target="#signupModal">SIGN UP</div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog d-flex justify-content-center">
                    <div class="modal-content col-md-12">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Your Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="step-row d-flex justify-content-center">
                                <div id="process"></div>
                                <div id="s1" class="step-col"><small>Step 1</small></div>
                                <div id="s2" class="step-col"><small>Step 2</small></div>
                                <div id="s3" class="step-col"><small>Step 3</small></div>
                            </div>
                            <form class="signup-form needs-validation" action="">
                                @csrf
                                <div id="form1" class="signup-section">
                                    <div class="d-flex justify-content-between">
                                        <div class="header-form h4">Personal Information</div>
                                    </div>
                                    <div class="input-group row">
                                        <div class="inner-form">
                                            <label for="fname">First Name:</label>
                                            <input type="text" id="fname" name="fname" class="form-input " placeholder="Firstname" required>
                                            <div class="invalid-feedback">
                                                Please enter your First Name
                                            </div>
                                        </div>

                                        <div class="inner-form">
                                            <label for="lname">Last Name:</label><br>
                                            <input type="text" id="lname" name="lname" class="form-input" placeholder="Lastname" required>
                                            <div class="invalid-feedback">
                                                Please enter your Last Name
                                            </div>
                                        </div>
                                        <div class="inner-form">
                                            <label for="bday">Birth Date:</label>
                                            <input type="date" id="bday" name="bday" class="form-input" required>
                                            <div class="invalid-feedback">
                                                Please select your Birth Date
                                            </div>
                                        </div>

                                        <div class="inner-form">
                                            <label for="gender">Birth Date:</label>
                                            <select name="gender" id="gender" class="form-option">
                                                <!-- <option selected></option> -->
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select your Gender
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-navigation">
                                        <button type="button" class="btn btn-success" id="pi-next">Next</button>
                                    </div>
                                </div>

                                <div id="form2" class="signup-section">
                                    <div class="d-flex justify-content-between">
                                        <div class="header-form h4">Account Information</div>
                                    </div>

                                    <div class="input-group row">
                                        <div class="inner-form">
                                            <label for="role">Role in the Company:</label>
                                            <select name="role" id="role" class="form-option">
                                                <option selected></option>
                                                <option value="Owner">Owner</option>
                                                <option value="Assisstant Manager">Assitant Manager</option>
                                                <option value="Cashier">Cashier</option>
                                                <option value="Inventory Manager">Inventory Manager</option>
                                            </select>
                                        </div>

                                        <div class="inner-form">
                                            <label for="email_su">Email:</label><br>
                                            <input type="email" id="email_su" name=email_su class="form-iput" placeholder="Email Address" required>
                                        </div>
                                    
                                        <div class="inner-form">
                                            <label for="password_su">Password:</label>
                                            <input type="password" id="password_su" name=password_su class="form-input" placeholder="Password" required>
                                        </div>
                                        
                                        <div class="inner-form>
                                            <label for="re-pass_su">Confirm Password:</label>
                                            <input type="password" id="re-pass_su" name=re-pass_su class="form-input" placeholder="Confirm Password" required>
                                        </div>
                                    </div>

                                    <div class="form-navigation">
                                        <button type="button" class="btn btn-success float-left" id="ai-back">Back</button>
                                        <button type="button" class="btn btn-success float-right" id="ai-next">Next</button>
                                    </div>
                                </div>

                                <div id="form3" class="signup-section">
                                    <div class="d-flex justify-content-between">
                                        <div class="header-form h4">Upload Profile</div>
                                    </div>

                                    <div class="input-group row">
                                        <div class="inner-form">
                                            <label for="imageUpload">Your Profile Image:</label>
                                            <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" accept="image/*" capture>
                                        </div>
                                    </div>

                                    <div class="form-navigation">
                                        <button type="button" class="btn btn-success float-left" id="up-back">Back</button>
                                        <button type="submit" class="btn btn-success float-right" id="up-submit">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
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
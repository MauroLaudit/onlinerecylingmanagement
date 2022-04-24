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
                <form class="signup-form needs-validation" action="register" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="form1" class="signup-section">
                        <div class="d-flex justify-content-between">
                            <div class="header-form h4">Personal Information</div>
                        </div>
                        <div class="input-group row">
                            <div class="inner-form">
                                <label for="fname">First Name:</label>
                                <input type="text" id="fname" name="fname" class="form-input " placeholder="First Name" required style="text-transform: capitalize;">
                            </div>
                            
                            <div class="inner-form">
                                <label for="mname">Middle Name: (optional)</label>
                                <input type="text" id="mname" name="mname" class="form-input" placeholder="Middle Name" style="text-transform: capitalize;">
                            </div>

                            <div class="inner-form">
                                <label for="lname">Last Name:</label>
                                <input type="text" id="lname" name="lname" class="form-input" placeholder="Last Name" required style="text-transform: capitalize;">
                            </div>

                            <div class="inner-form">
                                <label for="gender">Gender:</label>
                                <select name="gender" id="gender" class="form-option" required>
                                    <option selected>Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-navigation d-flex justify-content-end">
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
                                    <option selected>Choose Role</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Assistant Manager">Assistant Manager</option>
                                    <option value="Cashier">Cashier</option>
                                    <option value="Inventory Manager">Inventory Manager</option>
                                </select>
                            </div>

                            <div class="inner-form">
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" name="email" class="form-input" placeholder="Email Address" required >
                            </div>
                        
                            <div class="inner-form">
                                <div class="pass-rules d-flex align-items-center">
                                    <label for="password">Password:</label>
                                    <span class="password-viewer">
                                        <em class="fa fa-question-circle-o m-0 p-0" aria-hidden="true"></em>
                                        <div class="password-rules">
                                            <h6 style="font-weight:400;">Password must contain the following:</h6>
                                            <ul>
                                                <li><p id="capital" class="su_invalid">A <b>capital (uppercase)</b> letter</p></li>
                                                <li><p id="letter" class="su_invalid">A <b>lowercase</b> letter</p></li>
                                                <li><p id="char" class="su_invalid">A <b>Character(?,/,-,etc.)</b></p></li>
                                                <li><p id="number" class="su_invalid">A <b>number</b></p></li>
                                                <li><p id="length" class="su_invalid">Minimum <b>8 characters</b></p></li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <input type="password" id="password" name="password" class="form-input" placeholder="Password" required autocomplete="new-password">
                                    <span class="show-password d-flex align-items-center justify-content-end" id="show-pass"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            
                            <div class="inner-form">
                                <label for="confirm_password">Confirm Password:</label>
                                <div class="d-flex">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-input" placeholder="Confirm Password" required>
                                    <span class="show-password d-flex align-items-center justify-content-end" id="show-confirm-pass"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-navigation d-flex justify-content-between">
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
                                <label for="upload_img">Your Profile Image:</label>
                                <input id="upload_img" type="file" name="upload_img" placeholder="Photo" required="" accept="image/*" capture>
                            </div>
                        </div>

                        <div class="form-navigation d-flex justify-content-between">
                            <button type="button" class="btn btn-success float-left" id="up-back">Back</button>
                            <button type="submit" class="btn btn-success float-right" id="up-submit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>



<?php
$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;
?>
        <div class="page_header" data-parallax-bg-image="<?php echo base_url($cat_info->cat_image); ?>" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1><?php echo $cat_title1; ?></h1>
                                <p><?php echo $cat_title2; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->

        <div class="page_content">
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2">
                        <div class="form-content">
                            <h2><?php echo display('reset_your_password'); ?></h2>
                            <div class="row">
                                <!-- alert message -->
                                <?php if ($this->session->flashdata('message') != null) {  ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div> 
                                <?php } ?>                                
                                <?php if ($this->session->flashdata('exception') != null) {  ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('exception'); ?>
                                </div>
                                <?php } ?>                                
                                <?php if (validation_errors()) {  ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?> 
                            </div>

                            <?php echo form_open('home/resetPassword','id="resetPassword" novalidate'); ?>
                                <div class="form-group">
                                    <input class="form-control" name="verificationcode" id="verificationcode" placeholder="Verification code" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="newpassword" id="newpassword" placeholder="New Password" type="password" autocomplete="off">
                                    <div id="message">
										<p id="letter" class="invalid">A <b> lowercase</b> letter</p>
										<p id="capital" class="invalid">A <b> capital (uppercase)</b> letter</p>
										<p id="special" class="invalid">A <b> special</b></p>
										<p id="number" class="invalid">A <b> number</b></p>
										<p id="length" class="invalid">Minimum <b> 8 characters</b></p>
	                            	</div>
                                </div>
                            	<div class="form-group">
                            		<input class="form-control" name="r_pass" id="r_pass" placeholder="<?php echo display('conf_password'); ?>" type="password" onkeyup="rePassword()" >
                            	</div>

                                <button  type="submit" class="btn btn-success btn-block">Reset Password</button>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <!-- /.End of Page -->
                </div>
            </div>
        </div>

        <style>
        #message {
            display:none;
            position: relative;
            padding: 20px;
            margin-top: 10px;
        }
        #message p {
            margin-bottom: 0;
		    float: left;
		    display: inline-flex;
		    width: 100%;
        }
        .form-content .valid {
            color: green;
        }
        .form-content .valid:before {
            position: relative;
            left: -10px;
            content: "✔";
        }
        .form-content .invalid {
            color: red;
        }
        .form-content .invalid:before {
            position: relative;
            left: -10px;
            content: "✖";
        }
        </style>
        <script type="text/javascript">
        	//Confirm Password check
            function rePassword() {
                var pass = document.getElementById("pass").value;
                var r_pass = document.getElementById("r_pass").value;

                if (pass !== r_pass) {
                    document.getElementById("r_pass").style.borderColor = '#ff0000';
                    document.getElementById("r_pass").style.boxShadow = 'inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(255, 0, 0, .6)';
                    return false;
                }
                else{
                    document.getElementById("r_pass").style.borderColor = '#1cbbb4';
                    document.getElementById("r_pass").style.boxShadow = 'inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(28, 187, 180, .6)';
                    return true;
                }
            }

            var myInput = document.getElementById("newpassword");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var special = document.getElementById("special");
            var number = document.getElementById("number");
            var length = document.getElementById("length");

            myInput.onfocus = function() {
                document.getElementById("message").style.display = 'inline-table';
            }
            myInput.onblur = function() {
                document.getElementById("message").style.display = "none";
            }

            myInput.onkeyup = function() {

              var lowerCaseLetters = /[a-z]/g;
              if(myInput.value.match(lowerCaseLetters)) {  
                letter.classList.remove("invalid");
                letter.classList.add("valid");
              } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
              }

              var upperCaseLetters = /[A-Z]/g;
              if(myInput.value.match(upperCaseLetters)) {  
                capital.classList.remove("invalid");
                capital.classList.add("valid");
              } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
              }

              var specialCharacter = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
              if(myInput.value.match(specialCharacter)) {  
                special.classList.remove("invalid");
                special.classList.add("valid");
              } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
              }

              var numbers = /[0-9]/g;
              if(myInput.value.match(numbers)) {  
                number.classList.remove("invalid");
                number.classList.add("valid");
              } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
              }

              if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
              } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
              }
            }
        </script>


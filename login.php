<?php
    #display header from 'includes' folder
    include_once('includes/header.html');

    # if error is present from validating login form
    if(isset($error) && !empty($error)){

        # if userId or password is invalid, display modal and set content of modal
        echo "<script>
                $(document).ready(function(){
                    $('.modal-title').text('Error!');
                    $('.modal-body').text('Invalid User ID or Password! Try Again..');
                    $('#myModal').modal('show');
                });
            </script>";
    }

    # if error is present from validating create account form
    if(isset($_GET['error'])){
        $passError = $_GET['error'];
    
        if($passError == "pass-error"){

            # if password is not equal to confirm password, display modal and set content of modal
            echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Error!');
                        $('.modal-body').text('Password Not Matched! Try Again..');
                        $('#myModal').modal('show');
                    });
                </script>";
        }else if($passError == "email-uid-error"){

            # if userId or email already exists, display modal and set content of modal
            echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Error!');
                        $('.modal-body').text('Email or User ID already exists! Try Again..');
                        $('#myModal').modal('show');
                    });
                </script>";
        }
   
    }

    # if form processing is successful
    if(isset($_GET['success'])){
        echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Registered Successfully');
                        $('.modal-body').text('You are now registered! Login with your User Id to continue');
                        $('#myModal').modal('show');
                    });
                </script>";
    }

?>   
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mt-5">
            
                <h2 class="lg-header">NTB Stamp Duty and Registration Details</h2><br>
                <!-- toogle nav -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#login">Log in to your account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#signup">Create An Account</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- login tab -->
                    <div id="login" class="container tab-pane active pb-4"><br>
                        <!-- Login Form -->
                        <h2 class="htwo">Login</h2>
                        <b class="mt-2">Login to get started</b><br>
                        <hr class="float-left hr-line">
                        <br>

                        <!-- display if any error occurs-->
                        <span id="error-luID" class="p-1" style="color: red;"></span>
                        <!-- login form to login_action.php -->
                        <form action="login_action.php" method="post" name="form-login" onsubmit="return loginformValidation()">
                            <div class="form-group pb-2">
                                <input type="text" class="form-control" id="uID" name="l-uID" placeholder="Enter User ID" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="pwd" name="l-pwd" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group form-check pb-4">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"> Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-submit btn-block p-2">Login</button>
                        </form>
                        <!-- end of login form -->
                    </div>
                    <!-- end of login tab -->

                    <!-- create account tab -->
                    <div id="signup" class="container tab-pane fade pb-1"><br>
                        <!-- create account -->
                        <h2 class="htwo">Create An Account</h2>
                        <b class="mt-2">Create an account to get started</b><br>
                        <hr class="float-left hr-line">
                        <br>
                        <!-- display if any error occurs-->
                        <span id="error-name" class="p-1" style="color: red;"></span>
                        <span id="error-uID" class="p-1" style="color: red;"></span>
                        <span id="error-cpwd" class="p-1" style="color: red;"></span>
                        
                        <!-- create account form to signup_action.php -->
                        <form action="signup_action.php" method="post" class="form-inline" name="form-signup" onsubmit="return signupformValidation()">
                           
                            <input type="text" placeholder="Name" class="form-control mr-sm-3 mt-3" name="name" required>

                            <input type="text" placeholder="User ID"  class="form-control mt-3" name="uID" required>
                            
                            <input type="password" placeholder="Password" class="form-control mr-sm-3 mt-4" name="pwd" required>

                            <input type="password" placeholder="Confirm Password" class="form-control mt-4" name="cpwd" required>

                            <input type="email" placeholder="Email" class="form-control mr-sm-3 mt-4" name="email" required>

                            <input type="number" placeholder="Phone Number" class="form-control mt-4" name="phone" required>

                            <input type="submit" value="Sign Up" class="form-control mr-3 mt-4 btn-submit" name="submit">
                        </form>
                        <!-- end of create account form -->
                    </div>
                    <!-- end of create account tab -->
                </div>
                <!-- end of tab pane -->
                
            </div>
            <!-- end of first column -->
            <!-- illustration -->
            <div class="col-md-6 text-center mt-5 shadow" style="background-color: #fff; border-radius: 15px;">
                
                <img src="assets/images/signup.png" alt="Image Here" class="img-fluid">
            </div>
            <!-- end of second column -->
        </div>
    </div>
  
    <?php 
        # include modal
        include('includes/modal.html');

        #display footer from 'includes' folder
        include_once('includes/footer.html');
    ?>
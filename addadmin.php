<!-- add Admin User -->
<?php 
    #start session
    session_start();

    # if session has not been set i.e user has not logged in
    if(!isset($_SESSION['userID'])){
        # load login.php screen
        require_once('login_tool.php');
        load('login.php');
    }

    # connect database
    require('connect_db.php');

    #display header from 'includes' folder
    include_once('includes/header.html');

    # navigation header and side navigation
    include_once('includes/navigation.html');

    # if error is present from validating add admin account form
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

     # if add land detail form processing is successful
     if(isset($_GET['success'])){
        echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Success');
                        $('.modal-body').text('Record has been added successfully!');
                        $('#myModal').modal('show');
                    });
                </script>";

    }else if(isset($_GET['updated'])){
        # updated records successfully
        echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Success');
                        $('.modal-body').text('Record has been successfully updated.');
                        $('#myModal').modal('show');
                    });
                </script>";
    }

    # get values from database and assign to variables
    $user_id;
    $name;
    $pwd;
    $email;
    $phone;

    # if user navigates from viewadmin.php through edit button, get id and display records in fields
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        # get record based on user id
        $query = "SELECT id, user_id, name, password, email, phone_number FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        
        // if equal to 1, record is found
        if(mysqli_num_rows($result) == 1){

            # fetch array from database as rows
            while($row = mysqli_fetch_array($result)){

                # get values from database and assign to variables
                $user_id = $row['user_id'];
                $name = $row['name'];
                $pwd = $row['password'];
                $email = $row['email'];
                $phone = $row['phone_number'];  
            }

        }else{
            # record does not exist
            echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Error');
                        $('.modal-body').text('Record does not exist!');
                        $('#myModal').modal('show');
                    });
                </script>";
        }

    }

?>

<!-- display land details in tables -->
<div class="col-md-10 col-sm-9 pt-3 main-body">

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between">
        <span class="active-page">Add Admin User</span>
        <div><a href="viewadmin.php" class="btn btn-dark status-btn text-center">View Admin Users</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- form -->
    <div class="p-4 mr-5 ml-5 mb-5 mt-4 shadow" style="background-color: #fff; border-radius: 15px; border: 1px solid #052749">
        <b class="mt-2">Enter New Admin User Account</b><br>
        <hr class="float-left hr-line"><br>

        <!-- display if any error occurs-->
        <span id="error-name" class="p-1" style="color: red;"></span>
        <span id="error-uID" class="p-1" style="color: red;"></span>
        <span id="error-cpwd" class="p-1" style="color: red;"></span>
        
        <!-- add admin user form to addadmin_action.php -->
        <form action="addadmin_action.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; else echo 'new-rec';?>" method="post" name="form-signup" onsubmit="return signupformValidation()">
            
            <input type="text" placeholder="Name" class="form-control mr-sm-3 mt-3" name="name" value="<?php if(isset($_GET['id'])) echo $name ?>"required>

            <input type="text" placeholder="User ID"  class="form-control mt-3" name="uID" value="<?php if(isset($_GET['id'])) echo $user_id ?>" required>
            
            <input type="password" placeholder="Password" class="form-control mr-sm-3 mt-4" name="pwd" value="<?php if(isset($_GET['id'])) echo $pwd ?>" required>

            <input type="password" placeholder="Confirm Password" class="form-control mt-4" name="cpwd" value="<?php if(isset($_GET['id'])) echo $pwd ?>" required>

            <input type="email" placeholder="Email" class="form-control mr-sm-3 mt-4" name="email" value="<?php if(isset($_GET['id'])) echo $email ?>" required>

            <input type="number" placeholder="Phone Number" class="form-control mt-4" name="phone" value="<?php if(isset($_GET['id'])) echo $phone ?>" required>

            <input type="submit" value="Submit" class="form-control mr-3 mt-4 btn-submit" name="submit">
        </form>
        <!-- end of admin user form -->
    </div>
    
</div>

<?php 

    # navigation footer for header and side navigation
    include_once('includes/navigation-footer.html');

    # include modal
    include('includes/modal.html');

    #display footer from 'includes' folder
    include_once('includes/footer.html');
?>
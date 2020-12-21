<?php 
    # validate add admin user form and add values to database
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        # connect to database
        require_once('connect_db.php');

        # get input values
        $name = $_POST['name'];
        $uID = $_POST['uID'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        # check if user password is equal to confirm password
        if($_POST['pwd'] != $_POST['cpwd']){
            // password not matched
            $error = "pass-error";
            header("location: addadmin.php?error=$error");
        }else{

            # check if id is set for updating records
            if($_GET['id'] != 'new-rec'){
                $id = $_GET['id'];
                
                # update record
                $query1 = "UPDATE users SET user_id = '$uID', name = '$name', password = '$pwd', email = '$email', phone_number = '$phone' WHERE id = '$id'";
                $result1 = mysqli_query($conn, $query1);

                if($result1){
                    # updated successfully
                    header("location: addadmin.php?updated");
                    
                }else{
                    # error
                    header("location: addadmin.php?error");
                }

                mysqli_close($conn);

            }else{

                // password matched, check if user_ID or email already exists
                //create new record
                $query = "SELECT id FROM users WHERE user_id = '$uID' OR email = '$email'";
                $result = mysqli_query($conn, $query);

                // if not equal to 0, result is found i.e. email or userID already exists
                if(mysqli_num_rows($result) != 0){

                    // error, navigate to login page to display error
                    $error = "email-uid-error";
                    header("location: addadmin.php?error=$error");
                }else{
                    // success, email or user_id does not exist initially in db
                    // insert record into database
                    $q = "INSERT INTO users (user_id, name, password, email, phone_number) VALUES('$uID', '$name', '$pwd', '$email', '$phone')";
                    $r = mysqli_query($conn, $q);

                    if($r){
                        # registered successfully
                        header("location: addadmin.php?success");
                    }

                    mysqli_close($conn);

                    exit();

                }
            }
            
        }
    }
?>
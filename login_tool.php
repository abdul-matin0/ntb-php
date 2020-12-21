<?php 
    # configure url
    function load($page = 'login.php')
    {
        # begin url with protocol, domain then current directory
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

        # remove unwanted chracters
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
 
        # execute redirect then quit
        header("Location: $url");
        exit();
    }

    # function to validate user ID and password
    function validate($conn, $uID, $pwd){

        # check if userID and password exists in database
        $query = "SELECT id, user_id, name FROM users WHERE user_id='$uID' AND password='$pwd'";
        $result = mysqli_query($conn, $query);
        
        // if equal to 1, result is found i.e. userID and password is valid
        if(mysqli_num_rows($result) == 1){

            # fetch associative array from database as rows
            $row = mysqli_fetch_array($result);

            # $row = mysqli_fetch_assoc($result, MYSQLI_ASSOC);

            return array(true, $row);
        }else{

            # invalid userID and password
            $error[] = 'Invalid User ID or Password!';

            return array(false, $error);
        }

    }
?>
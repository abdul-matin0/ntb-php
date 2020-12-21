<?php 
    # validate login form with database

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        # open database connection
        require('connect_db.php');

        # get connection, load and validate functions
        require('login_tool.php');

        # check login from login_tool.php
        list($check, $data) = validate($conn, $_POST['l-uID'], $_POST['l-pwd']);

        # if true, userId and password is valid
        if($check){

             # access session
             session_start();

             $_SESSION['userID'] = $data['user_id'];
             $_SESSION['name'] = $data['name'];

            # load index page
            load('index.php');
        }else{
            $error = $data;
        }

        # close database connection
        mysqli_close($conn);

    }

    # continue to display login page on failure
    include('login.php');

?>
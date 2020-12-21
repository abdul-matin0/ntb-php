<!-- logout -->
<?php 
    #start session
    session_start();

    # destroy session
    session_destroy();

    # log user out
    header('location: index.php');
    
?>
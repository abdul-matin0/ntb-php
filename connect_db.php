<?php 
    # connect to database
    $host = "localhost";    # host
    $username = "root";     # host username
    $password = "";         # host password
    $dbname = "ntb_stampduty";  # name of database

    $conn = mysqli_connect($host, $username, $password, $dbname) 
    OR die(mysqli_connect_error());

    #set encoding to match PHP script encoding
    mysqli_set_charset($conn, 'utf8');


    # function to automatically generate a unique id
    function uniqidReal($lenght = 5) {
    
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

?>
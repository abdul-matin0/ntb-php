<?php 
    # validate add land details form and add values to database
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        # connect to database
        require_once('connect_db.php');

        # get input values
        $l_address = $_POST['l-address'];
        $l_cost_wp = $_POST['l-cost-wp'];
        $l_cost_ap = $_POST['l-cost-ap'];
        $l_landmark = $_POST['l-landmark'];
        $l_area = $_POST['l-area'];
        $l_date_pur = $_POST['l-date-pur'];
        $l_location = $_POST['l-location'];

        # check if id is set for updating records
        if($_GET['id'] != 'new-rec'){
            $id = $_GET['id'];
            
            # update record
            $query = "UPDATE land_details SET address = '$l_address', cost_when_purchased = '$l_cost_wp', cost_at_present = '$l_cost_ap', landmark = '$l_landmark', area = '$l_area', date_purchased = '$l_date_pur', location = '$l_location' WHERE id = '$id'";
            $result = mysqli_query($conn, $query);

            if($result){
                # updated successfully
                header("location: addland.php?updated");
                
            }else{
                # error
                header("location: addland.php?error");
            }

            mysqli_close($conn);

        }else{

            # variable to hold auto generated land id
            $land_id;

            # call function to generate unique id from connect_db.php and store value in $land_id
            $land_id = "land" . uniqidReal(5);

            // insert record into database
            $q = "INSERT INTO land_details (land_id, address, cost_when_purchased, cost_at_present, landmark, area, date_purchased, location) VALUES('$land_id', '$l_address', '$l_cost_wp', '$l_cost_ap', '$l_landmark', '$l_area', '$l_date_pur', '$l_location')";
            $r = mysqli_query($conn, $q);

            if($r){
                # inserted successfully
                header("location: addland.php?success");
            }else{
                # error
                header("location: addland.php?error");
            }

            mysqli_close($conn);


        }
        // exit();
    }

    # continue to display add land page on failure
    include('addland.php');

?>
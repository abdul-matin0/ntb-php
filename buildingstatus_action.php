<?php 
    # validate add building status form and add values to database
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        # connect to database
        require_once('connect_db.php');

        # get input values
        $bs_id = $_POST['bs-id'];
        $bs_cc = $_POST['bs-cc'];
        $bs_op = $_POST['bs-op'];
        $bs_opr = $_POST['bs-opr'];
        $bs_sold = $_POST['bs-sold'];
        $bs_date = $_POST['bs-date'];
        $bs_area = $_POST['bs-area'];
        $bs_cost = $_POST['bs-cost'];

        # check if id is set for updating records
        if($_GET['id'] != 'new-rec'){
            $id = $_GET['id'];
            
            # update record (land status)
            $query = "UPDATE building_status SET constructed_completely = '$bs_cc', occupancy_permit = '$bs_op', occupancy_permit_received = '$bs_opr', sold = '$bs_sold', date_occupancy_permit_received = '$bs_date', area = '$bs_area', cost = '$bs_cost' WHERE building_id = '$id'";
            $result = mysqli_query($conn, $query);

            if($result){
                # updated successfully
                header("location: addbuildingstatus.php?updated");
                
            }else{
                # error
                header("location: addbuildingstatus.php?error");
            }

            mysqli_close($conn);

        }else{

            // insert building status record into database
            $q = "INSERT INTO building_status (building_id, constructed_completely, occupancy_permit, occupancy_permit_received, sold, date_occupancy_permit_received, area, cost) VALUES('$bs_id', '$bs_cc', '$bs_op', '$bs_opr', '$bs_sold', '$bs_date', '$bs_area', '$bs_cost')";
            $r = mysqli_query($conn, $q);

            if($r){
                # inserted successfully
                header("location: addbuildingstatus.php?success");
            }else{
                # error
                header("location: addbuildingstatus.php?error");
            }

            mysqli_close($conn);


        }
        // exit();
    }

    # continue to display addbuildingstatus page on failure
    include('addbuildingstatus.php');

?>
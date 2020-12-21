<?php 
    # validate add land status form and add values to database
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        # connect to database
        require_once('connect_db.php');

        # get input values
        $ls_id = $_POST['ls-id'];
        $ls_bpa = $_POST['ls-bpa'];
        $ls_bpr = $_POST['ls-bpr'];
        $ls_bc = $_POST['ls-bc'];
        $ls_op = $_POST['ls-op'];
        $ls_opr = $_POST['ls-opr'];
        $ls_sold = $_POST['ls-sold'];
        $ls_date = $_POST['ls-date'];

        # check if id is set for updating records
        if($_GET['id'] != 'new-rec'){
            $id = $_GET['id'];
            
            # update record (land status)
            $query = "UPDATE land_status SET building_permit = '$ls_bpa', building_permit_received = '$ls_bpr', building_constructed = '$ls_bc', occupancy_permit = '$ls_op', occupancy_permit_received = '$ls_opr', sold = '$ls_sold', date_building_permit_received = '$ls_date' WHERE land_id = '$id'";
            $result = mysqli_query($conn, $query);

            if($result){
                # updated successfully
                header("location: addlandstatus.php?updated");
                
            }else{
                # error
                header("location: addlandstatus.php?error");
            }

            mysqli_close($conn);

        }else{

            // insert land status record into database
            $q = "INSERT INTO land_status (land_id, building_permit, building_permit_received, building_constructed, occupancy_permit, occupancy_permit_received, sold, date_building_permit_received) VALUES('$ls_id', '$ls_bpa', '$ls_bpr', '$ls_bc', '$ls_op', '$ls_opr', '$ls_sold', '$ls_date')";
            $r = mysqli_query($conn, $q);

            if($r){
                # inserted successfully
                header("location: addlandstatus.php?success");
            }else{
                # error
                header("location: addlandstatus.php?error");
            }

            mysqli_close($conn);


        }
        // exit();
    }

    # continue to display addlandstatus page on failure
    include('addlandstatus.php');

?>
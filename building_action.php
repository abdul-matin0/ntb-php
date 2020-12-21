<?php 
    # validate add building details form and add values to database
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        # connect to database
        require_once('connect_db.php');

        # get input values
        $land_id = $_POST['b-l-id'];
        $type_building = $_POST['b-type'];
        $name_building = $_POST['b-name'];
        $building_location = $_POST['b-location'];
        $num_floors = $_POST['b-num-floors'];
        $num_rooms = $_POST['b-num-rooms'];
        $date_cons = $_POST['b-date-cons'];

        # check if id is set for updating records
        if($_GET['id'] != 'new-rec'){
            $id = $_GET['id'];
            
            # update record
            $query = "UPDATE building_details SET land_id = '$land_id', type_of_building = '$type_building', name_of_building = '$name_building', building_location = '$building_location', num_of_floors = '$num_floors', num_of_rooms = '$num_rooms', date_building_constructed = '$date_cons' WHERE id = '$id'";
            $result = mysqli_query($conn, $query);

            if($result){
                # updated successfully
                header("location: addbuilding.php?updated");
                
            }else{
                # error
                header("location: addbuilding.php?error");
            }

            mysqli_close($conn);

        }else{

            # variable to hold auto generated land id
            $building_id;

            # call function to generate unique id from connect_db.php and store value in $building_id
            $building_id = "building" . uniqidReal(5);

            // insert record into database
            $q = "INSERT INTO building_details (building_id, land_id, type_of_building, name_of_building, building_location, num_of_floors, num_of_rooms, date_building_constructed) VALUES('$building_id', '$land_id', '$type_building', '$name_building', '$building_location', '$num_floors', '$num_rooms', '$date_cons')";
            $r = mysqli_query($conn, $q);

            if($r){
                # inserted successfully
                header("location: addbuilding.php?success");
            }else{
                # error
                header("location: addbuilding.php?error");
            }

            mysqli_close($conn);


        }
        // exit();
    }

    # continue to display building page on failure
    include('addbuilding.php');

?>
<!-- add building details -->
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

     # if add building detail form processing is successful
     if(isset($_GET['success'])){
        echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Success');
                        $('.modal-body').text('Record has been added successfully!');
                        $('#myModal').modal('show');
                    });
                </script>";

    }else if(isset($_GET['error'])){
        # if any error occurred
        echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Error');
                        $('.modal-body').text('Something Went Wrong. Try Again!');
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
    $land_id;
    $type_building;
    $name_building;
    $building_location;
    $num_floors;
    $num_rooms;
    $date_cons;


    # if user navigates from building.php through edit button, get id and display records in fields
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        # get record based on building id
        $query = "SELECT building_id, land_id, type_of_building, name_of_building, building_location, num_of_floors, num_of_rooms, date_building_constructed FROM building_details WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        
        // if equal to 1, record is found
        if(mysqli_num_rows($result) == 1){

            # fetch array from database as rows
            while($row = mysqli_fetch_array($result)){

                # get values from database and assign to variables
                $land_id = $row['land_id'];
                $type_building = $row['type_of_building'];
                $name_building = $row['name_of_building'];
                $building_location = $row['building_location'];
                $num_floors = $row['num_of_floors'];
                $num_rooms = $row['num_of_rooms'];
                $date_cons = $row['date_building_constructed'];   
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
        <span class="active-page">Add Building Details</span>
        <div><a href="building.php" class="btn btn-dark status-btn text-center">View Building Details</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- form -->
    <div class="p-4 shadow" style="background-color: #fff; border-radius: 15px; border: 1px solid #052749">
        <!-- add building details form to building_action.php -->
        <form action="building_action.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; else echo 'new-rec';?>" method="post" name="form-land">
            <label class="pb-3">*Building ID would be auto-generated</label>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="b-l-id" name="b-l-id" placeholder="Enter Land ID" value="<?php if(isset($_GET['id'])) echo $land_id ?>" required>
            </div>
            <div class="form-group pb-2">
                <label for="b-type">*Select Type Of Building</label>
                <select class="form-control" id="b-type" name="b-type">
                    <?php
                        $Oselected = '';
                        $Rselected = '';
                        $Sselected = '';

                        if(isset($_GET['id'])){
                            if($type_building == 'Official Complex'){
                                $Oselected = 'selected';
                            }else if($type_building == 'Residential Complex'){
                                $Rselected = 'selected';
                            }else if($type_building == 'Shopping Complex'){
                                $Sselected = 'selected';
                            }
                        }
                    ?>
                    
                    <option <?php if(isset($_GET['id'])) echo $Oselected ?>>Official Complex</option>
                    <option <?php if(isset($_GET['id'])) echo $Rselected ?>>Residential Complex</option> <!-- selected -->
                    <option <?php if(isset($_GET['id'])) echo $Sselected ?>>Shopping Complex</option>
                    
                </select>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="b-name" name="b-name" placeholder="Enter Name Of Building" value="<?php if(isset($_GET['id'])) echo $name_building ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="b-location" name="b-location" placeholder="Enter Building Location" value="<?php if(isset($_GET['id'])) echo $building_location ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="number" class="form-control" id="b-num-floors" name="b-num-floors" placeholder="Enter Number Of Floors" value="<?php if(isset($_GET['id'])) echo $num_floors ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="number" class="form-control" id="b-num-rooms" name="b-num-rooms" placeholder="Enter Number Of Rooms" value="<?php if(isset($_GET['id'])) echo $num_rooms ?>" required>
            </div>
            <div class="form-group pb-2">
                <label for="b-date-cons">*Enter Date On Which The Building Is Constructed</label>
                <input type="date" class="form-control" id="b-date-cons" name="b-date-cons" placeholder="Enter Date Building Is Constructed" value="<?php if(isset($_GET['id'])) echo $date_cons ?>" required>
            </div>
            <button type="submit" class="btn btn-submit btn-block p-2">Submit</button>
        </form>
        <!-- end of login form -->
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
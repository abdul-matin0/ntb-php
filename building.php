<!-- view building details -->
<?php 
    #start session
    session_start();

    # if session has not been set i.e user has not logged in
    if(!isset($_SESSION['userID'])){
        # load login.php screen
        require_once('login_tool.php');
        load('login.php');
    }

    # database connection
    require('connect_db.php');

    #display header from 'includes' folder
    include_once('includes/header.html');

    # navigation header and side navigation
    include_once('includes/navigation.html');

    # delete record from database
    if(isset($_GET['delid'])){
        $del_id = $_GET['delid'];

        # delete selected record from building_details table
        $q = "DELETE FROM building_details WHERE id = '$del_id'";
        $r = mysqli_query($conn, $q);

        if($r){
            # record deleted successfully
            echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Success');
                        $('.modal-body').text('Record has been deleted successfully!');
                        $('#myModal').modal('show');
                    });
                </script>";

        }else{
            # error
            echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Error');
                        $('.modal-body').text('Something Went Wrong. Try Again!');
                        $('#myModal').modal('show');
                    });
                </script>";
        }
    }

?>

<!-- display building details in tables -->
<div class="col-md-10 col-sm-9 pt-3 main-body">

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between">
        <span class="active-page">Building Details</span>
        <div><a href="addbuilding.php" class="btn btn-dark status-btn text-center">Add Building Details</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Building ID</th>
                    <th>Land ID</th>
                    <th>Type Of Building</th>
                    <th>Name Of Building</th>
                    <th>Building Location</th>
                    <th>Number Of Floors</th>
                    <th>Number Of Rooms</th>
                    <th>Date Building Is Constructed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    # display building details record from database
                    $query = "SELECT id, building_id, land_id, type_of_building, name_of_building, building_location, num_of_floors, num_of_rooms, date_building_constructed FROM building_details";
                    $result = mysqli_query($conn, $query);

                    // if equal to 1, result is found i.e. table is not empty
                    if(mysqli_num_rows($result) > 0){

                         # loop through database table to get and display records
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            # display row
                            echo "<tr>
                                    <td>{$row['building_id']}</td>
                                    <td>{$row['land_id']}</td>
                                    <td>{$row['type_of_building']}</td>
                                    <td>{$row['name_of_building']}</td>
                                    <td>{$row['building_location']}</td>
                                    <td>{$row['num_of_floors']}</td>
                                    <td>{$row['num_of_rooms']}</td>
                                    <td>{$row['date_building_constructed']}</td>
                                    <td class=\"text-center\">
                                        <a href=\"buildingstatus.php?id={$row['building_id']}\" class=\"btn btn-success status-btn\">View Building Status</a>
                                        <a href=\"addbuilding.php?id={$row['id']}\" class=\"btn btn-warning edit-btn\">Edit</a>
                                        <a href=\"building.php?delid={$row['id']}\" class=\"btn btn-danger mt-1 delete-btn\">Delete</a>
                                    </td>
                
                                </tr>";

                        }
                    }else{
                        # database table is empty i.e. no record
                        echo "<tr><td colspan=\"9\">No Record! Click here to add building record <a href=\"addbuilding.php\" class=\"btn btn-success ml-3\">Add Building Details</a></td>";
                    }
                   
                ?>
            </tbody>
        </table>
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
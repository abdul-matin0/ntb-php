<!-- view building status -->
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

    $b_ID = "";

    # get input building id to use to display building status
    if(isset($_GET['b-ID'])){

        # get input value
        $b_ID = $_GET['b-ID'];
    }

    # if user navigates from building.php
    if(isset($_GET['id'])){
        # get building ID and display status
        $b_ID = $_GET['id'];
    }

    # delete record from database
    if(isset($_GET['delid'])){
        $del_id = $_GET['delid'];

        # delete selected record from land_details table
        $q = "DELETE FROM building_status WHERE id = '$del_id'";
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

<!-- display building status details in tables -->
<div class="col-md-10 col-sm-9 pt-3 main-body">

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between">
        <span class="active-page">Building Status</span>
        <div><a href="building.php" class="btn btn-dark status-btn text-center">View Building Details</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- input form to get building ID to display building status -->
    <div class="mt-3 mb-4">
        <label for="b-ID">*Enter Building ID To Display Associated Building Status</label>
        <form action="buildingstatus.php" class="form-inline">
            <input type="text" class="form-control pr-5" id="b-ID" name="b-ID" placeholder="Enter Building ID" value="<?php if(isset($_GET['id'])) echo $b_ID ?>" required>
            <input type="submit" value="Search" class="form-control ml-3 btn-submit" name="submit">
        </form>

    </div>

    <!-- table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Building ID</th>
                    <th>Constructed Completely</th>
                    <th>Occupancy Permit</th>
                    <th>Occupancy Permit Received</th>
                    <th>Sold</th>
                    <th>Date Occupancy Permit Received</th>
                    <th>Area</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    # display land status record from database
                    $query = "SELECT id, building_id, constructed_completely, occupancy_permit, occupancy_permit_received, sold, date_occupancy_permit_received, area, cost FROM building_status WHERE building_id = '$b_ID'";
                    $result = mysqli_query($conn, $query);

                    // if equal to 1, result is found i.e. table is not empty
                    if(mysqli_num_rows($result) > 0){

                         # loop through database table to get and display records
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            # display row
                            echo "<tr>
                                    <td>{$row['building_id']}</td>
                                    <td>{$row['constructed_completely']}</td>
                                    <td>{$row['occupancy_permit']}</td>
                                    <td>{$row['occupancy_permit_received']}</td>
                                    <td>{$row['sold']}</td>
                                    <td>{$row['date_occupancy_permit_received']}</td>
                                    <td>{$row['area']}</td>
                                    <td>{$row['cost']}</td>
                                    <td class=\"text-center\">
                                        <a href=\"building.php\" class=\"btn btn-success status-btn\">View Building Details</a>
                                        <a href=\"addbuildingstatus.php?id={$row['building_id']}\" class=\"btn btn-warning edit-btn\">Edit</a>
                                        <a href=\"buildingstatus.php?delid={$row['id']}\" class=\"btn btn-danger mt-1 delete-btn\">Delete</a>
                                    </td>
                
                                </tr>";
                        }
                    }else{
                        if(isset($_GET['id']) || isset($_GET['b-ID'])){
                            # get building ID and display status
                            # database table is empty i.e. no record
                            echo "<script>
                                    $(document).ready(function(){
                                        $('.modal-title').text('Empty');
                                        $('.modal-body').text('No Building Status found associated with the given Building ID inputed!');
                                        $('#myModal').modal('show');
                                    });
                                </script>";

                            echo "<tr><td colspan=\"9\">Enter a valid Building ID in the input field or <a href=\"addbuildingstatus.php\" class=\"btn btn-success ml-3\">Add A New Building Status</a> <a href=\"building.php\" class=\"btn btn-dark status-btn ml-1\">View Building Details</a></td>";    
                        }else{

                            echo "<tr><td colspan=\"9\">Enter a Building ID in the input field to view Building Status or <a href=\"addbuildingstatus.php\" class=\"btn btn-success ml-3\">Add A New Building Status</a> <a href=\"building.php\" class=\"btn btn-dark status-btn ml-1\">View Building Details</a></td>";
                        }
                        
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
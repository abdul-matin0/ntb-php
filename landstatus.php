<!-- view land status -->
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

    $ls_ID = "";

    # get input land id to use to display land status
    if(isset($_GET['ls-ID'])){

        # get input value
        $ls_ID = $_GET['ls-ID'];
    }

    # if user navigates from land.php
    if(isset($_GET['id'])){
        # get land ID and display status
        $ls_ID = $_GET['id'];
    }

    # delete record from database
    if(isset($_GET['delid'])){
        $del_id = $_GET['delid'];

        # delete selected record from land_details table
        $q = "DELETE FROM land_status WHERE id = '$del_id'";
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

<!-- display land details in tables -->
<div class="col-md-10 col-sm-9 pt-3 main-body">

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between">
        <span class="active-page">Land Status</span>
        <div><a href="land.php" class="btn btn-dark status-btn text-center">View Land Details</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- input form to get land ID to display land status -->
    <div class="mt-3 mb-4">
        <label for="ls-ID">*Enter Land ID To Display Associated Land Status</label>
        <form action="landstatus.php" class="form-inline">
            <input type="text" class="form-control pr-5" id="ls-ID" name="ls-ID" placeholder="Enter Land ID" value="<?php if(isset($_GET['id'])) echo $ls_ID ?>" required>
            <input type="submit" value="Search" class="form-control ml-3 btn-submit" name="submit">
        </form>

    </div>

    <!-- table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Land ID</th>
                    <th>Building Permit</th>
                    <th>Building Permit Received</th>
                    <th>Building Constructed</th>
                    <th>Occupancy Permit</th>
                    <th>Occupancy Permit Received</th>
                    <th>Sold</th>
                    <th>Date Of Receiving Building Permit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    # display land status record from database
                    $query = "SELECT id, land_id, building_permit, building_permit_received, building_constructed, occupancy_permit, occupancy_permit_received, sold, date_building_permit_received FROM land_status WHERE land_id = '$ls_ID'";
                    $result = mysqli_query($conn, $query);

                    // if equal to 1, result is found i.e. table is not empty
                    if(mysqli_num_rows($result) > 0){

                         # loop through database table to get and display records
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            # display row
                            echo "<tr>
                                    <td>{$row['land_id']}</td>
                                    <td>{$row['building_permit']}</td>
                                    <td>{$row['building_permit_received']}</td>
                                    <td>{$row['building_constructed']}</td>
                                    <td>{$row['occupancy_permit']}</td>
                                    <td>{$row['occupancy_permit_received']}</td>
                                    <td>{$row['sold']}</td>
                                    <td>{$row['date_building_permit_received']}</td>
                                    <td class=\"text-center\">
                                        <a href=\"land.php\" class=\"btn btn-success status-btn\">View Land Details</a>
                                        <a href=\"addlandstatus.php?id={$row['land_id']}\" class=\"btn btn-warning edit-btn\">Edit</a>
                                        <a href=\"landstatus.php?delid={$row['id']}\" class=\"btn btn-danger mt-1 delete-btn\">Delete</a>
                                    </td>
                
                                </tr>";
                        }
                    }else{
                        if(isset($_GET['id']) || isset($_GET['ls-ID'])){
                            # get land ID and display status
                            # database table is empty i.e. no record
                            echo "<script>
                                    $(document).ready(function(){
                                        $('.modal-title').text('Empty');
                                        $('.modal-body').text('No Land Status found associated with the given Land ID inputed!');
                                        $('#myModal').modal('show');
                                    });
                                </script>";

                            echo "<tr><td colspan=\"9\">Enter a valid Land ID in the input field or <a href=\"addlandstatus.php\" class=\"btn btn-success ml-3\">Add A New Land Status</a> <a href=\"land.php\" class=\"btn btn-dark status-btn ml-1\">View Land Details</a></td>";    
                        }else{

                            echo "<tr><td colspan=\"9\">Enter a Land ID in the input field to view Land Status or <a href=\"addlandstatus.php\" class=\"btn btn-success ml-3\">Add A New Land Status</a> <a href=\"land.php\" class=\"btn btn-dark status-btn ml-1\">View Land Details</a></td>";
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
<!-- view land details -->
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

        # delete selected record from land_details table
        $q = "DELETE FROM land_details WHERE id = '$del_id'";
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
        <span class="active-page">Land Details</span>
        <div><a href="addland.php" class="btn btn-dark status-btn text-center">Add Land Details</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Land ID</th>
                    <th>Address</th>
                    <th>Cost When Purchased</th>
                    <th>Cost At Present</th>
                    <th>Near By Landmark</th>
                    <th>Area</th>
                    <th>Date Purchased</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    # display land details record from database
                    $query = "SELECT id, land_id, address, cost_when_purchased, cost_at_present, landmark, area, date_purchased, location FROM land_details";
                    $result = mysqli_query($conn, $query);

                    // if equal to 1, result is found i.e. table is not empty
                    if(mysqli_num_rows($result) > 0){

                         # loop through database table to get and display records
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            # display row
                            echo "<tr>
                                    <td>{$row['land_id']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['cost_when_purchased']}</td>
                                    <td>{$row['cost_at_present']}</td>
                                    <td>{$row['landmark']}</td>
                                    <td>{$row['area']}</td>
                                    <td>{$row['date_purchased']}</td>
                                    <td>{$row['location']}</td>
                                    <td class=\"text-center\">
                                        <a href=\"landstatus.php?id={$row['land_id']}\" class=\"btn btn-success status-btn\">View Land Status</a>
                                        <a href=\"addland.php?id={$row['id']}\" class=\"btn btn-warning edit-btn\">Edit</a>
                                        <a href=\"land.php?delid={$row['id']}\" class=\"btn btn-danger mt-1 delete-btn\">Delete</a>
                                    </td>
                
                                </tr>";

                        }
                    }else{
                        # database table is empty i.e. no record
                        echo "<tr><td colspan=\"9\">No Record! Click here to add record <a href=\"addland.php\" class=\"btn btn-success ml-3\">Add Land Details</a></td>";
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
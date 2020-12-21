<!-- view admin users -->
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

        # delete selected record from users table
        $q = "DELETE FROM users WHERE id = '$del_id'";
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

<!-- display admin users in tables -->
<div class="col-md-10 col-sm-9 pt-3 main-body">

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between">
        <span class="active-page">Admin Users Details</span>
        <div><a href="addadmin.php" class="btn btn-dark status-btn text-center">Add Admin Users</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    # display land details record from database
                    $query = "SELECT id, user_id, name, email, phone_number FROM users";
                    $result = mysqli_query($conn, $query);

                    // if equal to 1, result is found i.e. table is not empty
                    if(mysqli_num_rows($result) > 0){

                         # loop through database table to get and display records
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            # display row
                            echo "<tr>
                                    <td>{$row['user_id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone_number']}</td>
                                    <td class=\"text-center\">
                                        <a href=\"addadmin.php?id={$row['id']}\" class=\"btn btn-warning edit-btn\">Edit</a>
                                        <a href=\"viewadmin.php?delid={$row['id']}\" class=\"btn btn-danger mt-1 delete-btn\">Delete</a>
                                    </td>
                
                                </tr>";

                        }
                    }else{
                        # database table is empty i.e. no record
                        echo "<tr><td colspan=\"9\">No Record! Click here to add record <a href=\"addadmin.php\" class=\"btn btn-success ml-3\">Add Admin Users</a></td>";
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
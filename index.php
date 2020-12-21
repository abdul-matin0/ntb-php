<!-- index | dashboard -->
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
    require_once('connect_db.php');

    # display header from 'includes' folder
    include_once('includes/header.html');

    # navigation header and side navigation
    include_once('includes/navigation.html');

    # set total number of lands
    $_SESSION['no_of_land'] = 0;

    # set total number of building
    $_SESSION['no_of_building'] = 0;

    # set total number of admin users
    $_SESSION['no_of_admin'] = 0;

    # get total number of land details record from database
    $query = "SELECT land_id FROM land_details";
    $result = mysqli_query($conn, $query);

    // if equal to 1, result is found i.e. table is not empty
    if(mysqli_num_rows($result) > 0){

         # loop through database table to get number of records
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            # add number of row
            $_SESSION['no_of_land']++;
        }
    }else{
        # database table is empty i.e. no record
        $_SESSION['no_of_land'] = 0;    
    }

    # get total number of building record from database
    $query1 = "SELECT id FROM building_details";
    $result1 = mysqli_query($conn, $query1);

    // if equal to 1, result is found i.e. table is not empty
    if(mysqli_num_rows($result1) > 0){

         # loop through database table to get number of records
        while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
            # add number of row
            $_SESSION['no_of_building']++;
        }
    }else{
        # database table is empty i.e. no record
        $_SESSION['no_of_building'] = 0;    
    }

    # get total number of admin user record from database
    $query2 = "SELECT id FROM users";
    $result2 = mysqli_query($conn, $query2);

    // if equal to 1, result is found i.e. table is not empty
    if(mysqli_num_rows($result2) > 0){

         # loop through database table to get number of records
        while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
            # add number of row
            $_SESSION['no_of_admin']++;
        }
    }else{
        # database table is empty i.e. no record
        $_SESSION['no_of_admin'] = 0;    
    }
    
?>
    <!-- main body -->
    <div class="col-md-10 col-sm-9 pt-3 main-body">

        <!-- breadcrumb -->
        <div class="d-flex justify-content-between">
            <span class="active-page">Dashboard</span>
            <span>Admin Panel<hr class="hr-line"></span>
            
            <?php 
                #display the name of user
                echo "<span class='lg-header'><h3>Welcome {$_SESSION['name']}</h3>
                <b>User ID: {$_SESSION['userID']} </span></b>";

            ?>
        </div>
        <!-- cards -->
        <div class="mt-4">
            <div class="shadow-sm p-4 mb-4 bg-white d-flex justify-content-between rounded-lg card-border">
                <b>Total Number of Lands: <span><?php echo $_SESSION['no_of_land']; ?></span></b>
                <div>
                    <a href="land.php" class="btn btn-primary status-btn">View Land Details</a>
                    <a href="addland.php" class="btn btn-warning edit-btn">Add Land Details</a>
                </div>
                <i class="fa fa-window-maximize mr-2"></i>
            </div>
            
            <div class="shadow-sm p-4 mb-4 bg-white d-flex justify-content-between rounded-lg card-border">
                <b>Total Number of Buildings: <span><?php echo $_SESSION['no_of_building']; ?></span></b>
                <div>
                    <a href="building.php" class="btn btn-success status-btn">View Building Details</a>
                    <a href="addbuilding.php" class="btn btn-info edit-btn">Add Building Details</a>
                </div>
                <i class="fa fa-bank mr-2"></i>
            </div>

            <div class="shadow-sm p-4 mb-4 bg-white d-flex justify-content-between rounded-lg card-border">
                <b>Total Number of Admin Users: <span><?php echo $_SESSION['no_of_admin']; ?></span></b>
                <div>
                    <a href="viewadmin.php" class="btn btn-warning status-btn">View Admin Users</a>
                    <a href="addadmin.php" class="btn btn-dark edit-btn">Add Admin User</a>
                </div>
                <i class="fa fa-users mr-2"></i>
            </div>
        </div>

        <!-- end of main body -->
    </div>
        
<?php 

    # navigation footer for header and side navigation
    include_once('includes/navigation-footer.html');

    # include modal
    include('includes/modal.html');

    #display footer from 'includes' folder
    include_once('includes/footer.html');
?>
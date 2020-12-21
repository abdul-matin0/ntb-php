<!-- add building status -->
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

     # if add land detail form processing is successful
     if(isset($_GET['success'])){
        echo "<script>
                    $(document).ready(function(){
                        $('.modal-title').text('Success');
                        $('.modal-body').text('Building Status has been added successfully!');
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
                        $('.modal-body').text('Building Status Record has been successfully updated.');
                        $('#myModal').modal('show');
                    });
                </script>";
    }

    # declare variables
    $bs_id;
    $bs_cc;
    $bs_op;
    $bs_opr;
    $bs_sold;
    $bs_date;
    $bs_area;
    $bs_cost;

    # if user navigates from buildingstatus.php through edit button or add building status button, get id and display records in fields
    if(isset($_GET['id'])){
        $building_id = $_GET['id'];

        # get record based on building id
        $query = "SELECT building_id, constructed_completely, occupancy_permit, occupancy_permit_received, sold, date_occupancy_permit_received, area, cost FROM building_status WHERE building_id = '$building_id'";
        $result = mysqli_query($conn, $query);
        
        // if equal to 1, record is found
        if(mysqli_num_rows($result) == 1){

            # fetch array from database as rows
            while($row = mysqli_fetch_array($result)){

                # get values from database and assign to variables
                $bs_id = $row['building_id'];
                $bs_cc = $row['constructed_completely'];
                $bs_op = $row['occupancy_permit'];
                $bs_opr = $row['occupancy_permit_received'];
                $bs_sold = $row['sold'];
                $bs_date = $row['date_occupancy_permit_received'];
                $bs_area = $row['area'];
                $bs_cost = $row['cost'];  
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
        <span class="active-page">Add Building Status</span>
        <div>
            <a href="building.php" class="btn btn-dark status-btn text-center">View Building Details</a>
            <a href="buildingstatus.php" class="btn btn-success status-btn">View Building Status</a>
        </div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>
    
    <?php if(isset($_GET['id'])) echo "<h3 class=\"htwo ml-3\">Update Building Status </h3>"; ?>

    <!-- form -->
    <div class="p-4 mt-2 mb-2 shadow" style="background-color: #fff; border-radius: 15px; border: 1px solid #052749">
        <!-- add land status form to buildingstatus_action.php -->
        <form action="buildingstatus_action.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; else echo 'new-rec';?>" method="post" name="form-building-status">
            <div class="form-group pb-2">
                <label for="bs-id">Enter Associated Building ID<?php if(isset($_GET['id'])) echo "<b class=\"ml-3\">*You cannot change the Building ID </b>"; ?></label>
                <input type="text" class="form-control" id="bs-id" name="bs-id" placeholder="Enter Associated Building ID " value="<?php if(isset($_GET['id'])) echo $bs_id ?>" required>
            </div>

            <!-- if user navigates from buildingstatus.php through edit button, display records in select element -->
            <?php
                
                $ccNotSelected = '';
                $ccAppliedSelected = '';
                $opNotSelected = '';
                $opAppliedSelected = '';
                $oprNotSelected = '';
                $oprAppliedSelected = '';
                $soldNotSelected = '';
                $soldAppliedSelected = '';

                if(isset($_GET['id'])){
                    
                    if($bs_cc == 'Not Completed'){      # Construction Completed
                        $ccNotSelected = 'selected';
                    }else if($bs_cc == 'Completed'){
                        $ccAppliedSelected = 'selected';
                    }
                    if($bs_op == 'Not Applied'){      # Occupancy Permit
                        $opNotSelected = 'selected';
                    }else if($bs_op == 'Applied'){
                        $opAppliedSelected = 'selected';
                    }
                    if($bs_opr == 'Not Received'){      # Occupancy Permit Received
                        $oprNotSelected = 'selected';
                    }else if($bs_opr == 'Received'){
                        $oprAppliedSelected = 'selected';
                    }
                    if($bs_sold == 'Not Sold'){      # Sold
                        $soldNotSelected = 'selected';
                    }else if($bs_sold == 'Sold'){
                        $soldAppliedSelected = 'selected';
                    }
                }

            ?>
            <div class="form-group pb-2">
                <label for="bs-cc">Constructed Completely:</label>
                <select class="form-control" id="bs-cc" name="bs-cc">
                    <option <?php if(isset($_GET['id'])) echo $ccNotSelected ?>>Not Completed</option>
                    <option <?php if(isset($_GET['id'])) echo $ccAppliedSelected ?>>Completed</option> <!-- selected -->
                </select>
            </div>

            <div class="form-group pb-2">
                <label for="bs-op">Occupancy Permit:</label>
                <select class="form-control" id="bs-op" name="bs-op">
                    <option <?php if(isset($_GET['id'])) echo $opNotSelected ?>>Not Applied</option>
                    <option <?php if(isset($_GET['id'])) echo $opAppliedSelected ?>>Applied</option>
                </select>
            </div>

            <div class="form-group pb-2">
                <label for="bs-opr">Occupancy Permit Received:</label>
                <select class="form-control" id="bs-opr" name="bs-opr">
                    <option <?php if(isset($_GET['id'])) echo $oprNotSelected ?>>Not Received</option>
                    <option <?php if(isset($_GET['id'])) echo $oprAppliedSelected ?>>Received</option>
                </select>

            </div>

            <div class="form-group pb-2">
                <label for="bs-sold">Sold:</label>
                <select class="form-control" id="bs-sold" name="bs-sold">
                    <option <?php if(isset($_GET['id'])) echo $soldNotSelected ?>>Not Sold</option>
                    <option <?php if(isset($_GET['id'])) echo $soldAppliedSelected ?>>Sold</option>
                </select>    
            </div>
            
            <div class="form-group pb-2">
                <label for="bs-date">Date Occupancy Permit Received</label>
                <input type="date" class="form-control" id="bs-date" name="bs-date" value="<?php if(isset($_GET['id'])) echo $bs_date ?>" required>
            </div>

            <div class="form-group pb-2">
                <label for="bs-area">Area in sq.Ft(square feet)</label>
                <input type="text" class="form-control" id="bs-area" name="bs-area" value="<?php if(isset($_GET['id'])) echo $bs_area ?>" required>
            </div>

            <div class="form-group pb-2">
                <label for="bs-cost">Cost</label>
                <input type="text" class="form-control" id="bs-cost" name="bs-cost" value="<?php if(isset($_GET['id'])) echo $bs_cost ?>" required>
            </div>

            <button type="submit" class="btn btn-submit btn-block p-2">Submit</button>
        </form>
        <!-- end of add building status form -->
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
<!-- add land status -->
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
                        $('.modal-body').text('Land Status has been added successfully!');
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
                        $('.modal-body').text('Land Status Record has been successfully updated.');
                        $('#myModal').modal('show');
                    });
                </script>";
    }

    # declare variables
    $ls_id;
    $ls_bpa;
    $ls_bpr;
    $ls_bc;
    $ls_op;
    $ls_opr;
    $ls_sold;
    $ls_date;

    # if user navigates from landstatus.php through edit button or add land status button, get id and display records in fields
    if(isset($_GET['id'])){
        $land_id = $_GET['id'];

        # get record based on land id
        $query = "SELECT land_id, building_permit, building_permit_received, building_constructed, occupancy_permit, occupancy_permit_received, sold, date_building_permit_received FROM land_status WHERE land_id = '$land_id'";
        $result = mysqli_query($conn, $query);
        
        // if equal to 1, record is found
        if(mysqli_num_rows($result) == 1){

            # fetch array from database as rows
            while($row = mysqli_fetch_array($result)){

                # get values from database and assign to variables
                $ls_id = $row['land_id'];
                $ls_bpa = $row['building_permit'];
                $ls_bpr = $row['building_permit_received'];
                $ls_bc = $row['building_constructed'];
                $ls_op = $row['occupancy_permit'];
                $ls_opr = $row['occupancy_permit_received'];
                $ls_sold = $row['sold'];
                $ls_date = $row['date_building_permit_received'];  
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
        <span class="active-page">Add Land Status</span>
        <div>
            <a href="land.php" class="btn btn-dark status-btn text-center">View Land Details</a>
            <a href="landstatus.php" class="btn btn-success status-btn">View Land Status</a>
        </div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>
    
    <?php if(isset($_GET['id'])) echo "<h3 class=\"htwo ml-3\">Update Land Status </h3>"; ?>

    <!-- form -->
    <div class="p-4 mt-2 mb-2 shadow" style="background-color: #fff; border-radius: 15px; border: 1px solid #052749">
        <!-- add land status form to landstatus_action.php -->
        <form action="landstatus_action.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; else echo 'new-rec';?>" method="post" name="form-land-status">
            <div class="form-group pb-2">
                <label for="ls-id">Enter Associated Land ID<?php if(isset($_GET['id'])) echo "<b class=\"ml-3\">*You cannot change the Land ID </b>"; ?></label>
                <input type="text" class="form-control" id="ls-id" name="ls-id" placeholder="Enter Associated Land ID " value="<?php if(isset($_GET['id'])) echo $ls_id ?>" required>
            </div>

            <!-- if user navigates from landstatus.php through edit button, display records in select element -->
            <?php
                $notSelected = '';
                $appliedSelected = '';
                $bprNotSelected = '';
                $bprAppliedSelected = '';
                $bcNotSelected = '';
                $bcAppliedSelected = '';
                $opNotSelected = '';
                $opAppliedSelected = '';
                $oprNotSelected = '';
                $oprAppliedSelected = '';
                $soldNotSelected = '';
                $soldAppliedSelected = '';

                if(isset($_GET['id'])){
                    
                    if($ls_bpa == 'Not Applied'){       # building permit applied
                        $notSelected = 'selected';
                    }else if($ls_bpa == 'Applied'){
                        $appliedSelected = 'selected';
                    }
                     if($ls_bpr == 'Not Received'){    # building permit received
                        $bprNotSelected = 'selected';
                    }else if($ls_bpr == 'Received'){    
                        $bprAppliedSelected = 'selected';
                    }
                    if($ls_bc == 'Not Constructed'){      # building Constructed
                        $bcNotSelected = 'selected';
                    }else if($ls_bc == 'Constructed'){
                        $bcAppliedSelected = 'selected';
                    }
                    if($ls_op == 'Not Applied'){      # Occupancy Permit
                        $opNotSelected = 'selected';
                    }else if($ls_op == 'Applied'){
                        $opAppliedSelected = 'selected';
                    }
                    if($ls_opr == 'Not Received'){      # Occupancy Permit Received
                        $oprNotSelected = 'selected';
                    }else if($ls_opr == 'Received'){
                        $oprAppliedSelected = 'selected';
                    }
                    if($ls_sold == 'Not Sold'){      # Sold
                        $soldNotSelected = 'selected';
                    }else if($ls_sold == 'Sold'){
                        $soldAppliedSelected = 'selected';
                    }
                }

            ?>
            <div class="form-group pb-2">
                <label for="ls-bpa">Building Permit Applied:</label>
                <select class="form-control" id="ls-bpa" name="ls-bpa">
                    <option <?php if(isset($_GET['id'])) echo $notSelected ?>>Not Applied</option>
                    <option <?php if(isset($_GET['id'])) echo $appliedSelected ?>>Applied</option> <!-- selected -->
                </select>
            </div>

            <div class="form-group pb-2">
                <label for="ls-bpr">Building Permit Received:</label>
                <select class="form-control" id="ls-bpr" name="ls-bpr">
                    <option <?php if(isset($_GET['id'])) echo $bprNotSelected ?>>Not Received</option>
                    <option <?php if(isset($_GET['id'])) echo $bprAppliedSelected ?>>Received</option>
                </select>
            </div>

            <div class="form-group pb-2">
                <label for="ls-bc">Building Constructed:</label>
                <select class="form-control" id="ls-bc" name="ls-bc">
                    <option <?php if(isset($_GET['id'])) echo $bcNotSelected ?>>Not Constructed</option>
                    <option <?php if(isset($_GET['id'])) echo $bcAppliedSelected ?>>Constructed</option>
                </select>
            </div>

            <div class="form-group pb-2">
                <label for="ls-op">Occupancy Permit:</label>
                <select class="form-control" id="ls-op" name="ls-op">
                    <option <?php if(isset($_GET['id'])) echo $opNotSelected ?>>Not Applied</option>
                    <option <?php if(isset($_GET['id'])) echo $opAppliedSelected ?>>Applied</option>
                </select>
            </div>

            <div class="form-group pb-2">
                <label for="ls-opr">Occupancy Permit Received:</label>
                <select class="form-control" id="ls-opr" name="ls-opr">
                    <option <?php if(isset($_GET['id'])) echo $oprNotSelected ?>>Not Received</option>
                    <option <?php if(isset($_GET['id'])) echo $oprAppliedSelected ?>>Received</option>
                </select>

            </div>

            <div class="form-group pb-2">
                <label for="ls-sold">Sold:</label>
                <select class="form-control" id="ls-sold" name="ls-sold">
                    <option <?php if(isset($_GET['id'])) echo $soldNotSelected ?>>Not Sold</option>
                    <option <?php if(isset($_GET['id'])) echo $soldAppliedSelected ?>>Sold</option>
                </select>    
            </div>
            
            <div class="form-group pb-2">
                <label for="ls-date">Date Of Receiving Building Permit</label>
                <input type="date" class="form-control" id="ls-date" name="ls-date" value="<?php if(isset($_GET['id'])) echo $ls_date ?>" required>
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
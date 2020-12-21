<!-- add land details -->
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
    $land_address;
    $land_cost_wp;
    $land_cost_ap;
    $land_landmark;
    $land_area;
    $land_date_pur;
    $land_location;

    # if user navigates from land.php through edit button, get id and display records in fields
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        # get record based on building id
        $query = "SELECT land_id, address, cost_when_purchased, cost_at_present, landmark, area, date_purchased, location FROM land_details WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        
        // if equal to 1, record is found
        if(mysqli_num_rows($result) == 1){

            # fetch array from database as rows
            while($row = mysqli_fetch_array($result)){

                # get values from database and assign to variables
                $land_address = $row['address'];
                $land_cost_wp = $row['cost_when_purchased'];
                $land_cost_ap = $row['cost_at_present'];
                $land_landmark = $row['landmark'];
                $land_area = $row['area'];
                $land_date_pur = $row['date_purchased'];
                $land_location = $row['location'];   
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
        <span class="active-page">Add Land Details</span>
        <div><a href="land.php" class="btn btn-dark status-btn text-center">View Land Details</a></div>
        <span>Admin Panel<hr class="hr-line"></span>
        
    </div>

    <!-- form -->
    <div class="p-4 shadow" style="background-color: #fff; border-radius: 15px; border: 1px solid #052749">
        <!-- add land details form to land_action.php -->
        <form action="land_action.php?id=<?php if(isset($_GET['id'])) echo $_GET['id']; else echo 'new-rec';?>" method="post" name="form-land">
            <label class="pb-3">*Land ID would be auto-generated</label>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="l-address" name="l-address" placeholder="Enter Land Address" value="<?php if(isset($_GET['id'])) echo $land_address ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="l-cost-wp" name="l-cost-wp" placeholder="Enter Cost When Purchased" value="<?php if(isset($_GET['id'])) echo $land_cost_wp ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="l-cost-ap" name="l-cost-ap" placeholder="Enter Cost At Present" value="<?php if(isset($_GET['id'])) echo $land_cost_ap ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="l-landmark" name="l-landmark" placeholder="Enter Near-By Landmark" value="<?php if(isset($_GET['id'])) echo $land_landmark ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="l-area" name="l-area" placeholder="Enter Land Area" value="<?php if(isset($_GET['id'])) echo $land_area ?>" required>
            </div>
            <div class="form-group pb-2">
                <label for="l-date-pur">*Enter Date Purchased</label>
                <input type="date" class="form-control" id="l-date-pur" name="l-date-pur" placeholder="Enter Date Purchased" value="<?php if(isset($_GET['id'])) echo $land_date_pur ?>" required>
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control" id="l-location" name="l-location" placeholder="Enter Land Location" value="<?php if(isset($_GET['id'])) echo $land_location ?>" required>
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
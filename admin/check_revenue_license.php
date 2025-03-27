<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['admin_email']) && isset($_SESSION['admin_name'])) {

include "../connection.php";
error_reporting(0);
if (isset($_POST['search']))
{
	$dlno=$_POST['vehicle'];
		
	if(empty($dlno)){
        header("Location: check_revenue_license.php?error=Vehicle Number is required!");
        exit();
    }
    else{
        $sql=mysqli_query($conn,"select * from revenue_license where vehicle_no='$dlno'");
		
		if(mysqli_num_rows($sql))
		{
		$res=mysqli_fetch_assoc($sql);
		
		}
		else
		{
            header("Location: check_revenue_license.php?error= Invalid Vehicle Number!");
			exit();
		} 
    }	
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Revenue License | TOFDS Admin</title>

    <!--Elements inside the head tag includes goes here-->
    <?php 
        include_once '../includes/header.php';
    ?>

</head>


<body class="overlay-scrollbar">

    <!--Top navigation bar includes goes here-->
    <?php 
        include 'includes/topNav.php';
    ?>


    <!--==================================================================================================================================SECTION_02====================================================================================================================================-->

      <!-- Left sidebar navigation start here =============================================-->
    <div class="leftsidebar" id="sidebar">
        <ul class="leftsidebar-nav">
            <!--Left sidebar navigation items-->
            <li class="leftsidebar-nav-item" >
            <a href="dashboard.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-tachometer-alt fas"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="reminder.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa fa-bell"></i>
                    </div>
                    <span>Reminders</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
            <a href="add_traffic_officer.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-address-card fas"></i>
                    </div>
                    <span>Add Traffic Officer</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
            <a href="view_all_traffic_officers.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-users-cog fas"></i>
                    </div>
                    <span>View Traffic Officers</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="mtd_account.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-building fas"></i>
                    </div>
                    <span>RATSA Account</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-receipt fas"></i>
                    </div>
                    <span>Fines & Violations</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_all_drivers.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-users fas"></i>
                    </div>
                    <span>View Drivers</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="paid_fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-check-double fas"></i>
                    </div>
                    <span>Paid Fine Tickets</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="pending_fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-pause fas"></i>
                    </div>
                    <span>Pending Fine Tickets</span>
                </a>
            </li>
            
            <li class="leftsidebar-nav-item">
        <a href="../admin/check_revenue_license.php" class="leftsidebar-nav-link">
            <div>
                <i class="fa-list fas"></i>
                    </div>
                    <span>View Road Tax</span>
                </a>
            </li>
             <li class="leftsidebar-nav-item">
        <a href="profile.php" class="leftsidebar-nav-link">
            <div>
            <i class="fa fa-gear"></i>
                    </div>
                    <span>Settings</span>
                </a>
            </li>
            <!--Left sidebar navigation items-->
        </ul>
    </div>
    <!-- Left sidebar navigation end here ============================================-->


    <!--==================================================================================================================================SECTION_03====================================================================================================================================-->

    <!-- Dashboard main content start here =================================================-->
    <div class="dashwrapper">
            <div class="container-fluid">
                <h1 class="mt-4">View Road Tax</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Road Tax</li>
                </ol>
                <!--Warning msg goes here-->
				<?php if (isset($_GET['error'])) { ?>
						<div class="alert alert-danger" id="success-alert">
						<i class="fas fa-exclamation-circle"></i>
						<?php echo $_GET['error']; ?>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				<?php } ?>
                <?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success" id="success-alert">
        <i class="fas fa-check-circle"></i>
        <?php echo $_GET['success']; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>
                <!--Warning msg end-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> Road Tax Details
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!--View Drivers table includes goes here-->
                            <div class="card-body mobilePaading">

                            <form action="" method="POST">
                            <h3>Search Vehicle Details</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="vehicle" id="license_id" placeholder="Vehicle No">
                                </div>
                            </div>
                                <button type="submit" class="btn btn-primary mb-2" name="search"><i class="fas fa-search"></i> Search</button>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="reference_no">Reference No</label>
                                <input type="text" class="form-control" id="reference_no" value="<?php echo $res['reference_no']; ?>" disabled placeholder="Reference No" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="vehicle_no">Vehicle No</label>
                                <input type="text" class="form-control" id="vehicle_no" placeholder="Vehicle No" value="<?php echo $res['vehicle_no']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="license_duration">Vehicle Type</label>
                                <input type="text" class="form-control" id="vehicle_type" placeholder="Vehicle Type" value="<?php echo $res['vehicle_type']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="vehicle_owner">Fuel Type</label>
                                <input type="text" class="form-control" id="fuel_type" placeholder="Fuel Type" value="<?php echo $res['fuel_type']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="payment_type">Owner Name</label>
                                <input type="text" class="form-control" id="driver_name" placeholder="Owner Name" value="<?php echo $res['driver_name']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="amount">Email Address</label>
                                <input type="text" class="form-control" id="email" placeholder="Email Address" value="<?php echo $res['email']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="payment_type">Issue Date</label>
                                <input type="text" class="form-control" id="issue_date" placeholder="Issue Date" value="<?php echo $res['issue_date']; ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="amount">Expire Date</label>
                                <input type="text" class="form-control" id="expire_date" placeholder="Expire Date" value="<?php echo $res['expire_date']; ?>" disabled>
                            </div>
                        </div>
                         
                        </form>
                                <form action="update_revenue_license_action.php" method="POST">
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        
                                    </div>
                                </div>
                                <!-- Update Button -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#revenueLicenseModal">Update Road Tax</button>
                                  <?php if ($res) { ?>
                                    
                                    <?php } ?>
<!-- Modal -->
<div class="modal fade" id="revenueLicenseModal" tabindex="-1" role="dialog" aria-labelledby="revenueLicenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revenueLicenseModalLabel">Update Road Tax</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update_revenue_license_action.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="reference_no" value="<?php echo $res['reference_no']; ?>">
                    <div class="form-group">
                        <label for="vehicle_no">Vehicle No</label>
                        <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="<?php echo $res['vehicle_no']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">Owner Name</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" value="<?php echo $res['driver_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $res['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="issue_date">Issue Date</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="expire_date">Expire Date</label>
                        <input type="date" class="form-control" id="expire_date" name="expire_date" value="<?php echo date('y-m-d', strtotime("+365 days")); ?>" readonly>
                        <input type="hidden" id="expire_date" name="expire_date" value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Dashboard main content end here ========================================-->
   

    <!--Javascripts includes goes here-->
    <?php 
        include '../includes/footer.php';
    ?>

<script>
    // Automatically update the expire_date based on issue_date
    document.getElementById('issue_date').addEventListener('change', function () {
        const issueDate = new Date(this.value);
        const expireDate = new Date(issueDate);
        expireDate.setFullYear(issueDate.getFullYear() + 1); // Add one year to the issue date
        document.getElementById('expire_date').value = expireDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
    });
</script>
    <script type="text/javascript" language="javascript" src="../assets/vendors/bootstrap/bootstrap.min.js"></script>
    <script>
    	//To close the success & error alert with slide up animation
	$("#success-alert").delay(4000).fadeTo(2000, 500).slideUp(1000, function(){
    	$("#success-alert").slideUp(1000);
	});
    </script>



</body>

</html>

<?php
}else{ 
	header("Location: index.php");
	exit();
}
?>
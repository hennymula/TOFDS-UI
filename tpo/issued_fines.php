<?php
session_start();
if (isset($_SESSION['police_id']) && isset($_SESSION['officer_email']) && isset($_SESSION['officer_name']) && isset($_SESSION['police_station']) && isset($_SESSION['court'])) {
?>



<!DOCTYPE html>
<html>

<head>
    <title>Issued fines | Traffic Police Officer</title>

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
	<!--View Drivers table-get data goes here-->
	<?php
	   include "../connection.php";
	   $sql = "SELECT * FROM issued_fines where police_id = '".$_SESSION['police_id']."'";
	   $result = mysqli_query($conn, $sql);  		
   	?>


    <!--==================================================================================================================================SECTION_02====================================================================================================================================-->

        <!-- Left sidebar navigation start here =============================================-->
        <div class="leftsidebar" id="sidebar">
        <ul class="leftsidebar-nav">
            <!--Left sidebar navigation items-->
            <li class="leftsidebar-nav-item">
                <a href="dashboard.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="add_new_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <span>Add Violation</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="driver_past_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-history"></i>
                    </div>
                    <span>Driver Violation History</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="check_revenue_license.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <span>View Road Tax</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_reported_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <span>View Violations</span>
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
                <h1 class="mt-4">Issued Fines</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Issued Fines</li>
                </ol>
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> You can sort data here
                    </div>					
                    <div class="card-body">
                    <div class="table-responsive" id="employee_table">
    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
        <!-- Alert box -->
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" id="danger-alert">
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

        <thead>
            <tr>
                <th>Action</th>
                <th>Reference No.</th>
                <th>License ID</th>
                <th>Police ID</th>
                <th>Provisions</th>
                <th>Total Amount</th>
                <th>Expire Date</th>
                <th>Court Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Action</th>
                <th>Reference No.</th>
                <th>License ID</th>
                <th>Police ID</th>
                <th>Provisions</th>
                <th>Total Amount</th>
                <th>Expire Date</th>
                <th>Court Date</th>
                <th>Status</th>
            </tr>
        </tfoot>
        <tbody>
            <?php 
            while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td>
                        <!-- View Button -->
                        <button type="button" name="view" value="View" id="<?php echo $row['ref_no']; ?>" class="btn btn-info btn-xs view_data">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>
                    <td><?php echo $row['ref_no']; ?></td>
                    <td><?php echo $row['license_id']; ?></td>
                    <td><?php echo $row['police_id']; ?></td>
                    <td><?php echo $row['provisions']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['expire_date']; ?></td>
                    <td><?php echo $row['court_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Dashboard main content end here ========================================-->

    <!--Paid Fine Tickets popup modals-->	
	
	<!--Popup modal for view Paid Fine Ticket details-->
	<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="exampleModalLabel">
                    <i class="fas fa-user"></i> Issued Fine Details
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="fine_detail">
                <!-- Details will be loaded here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
	

    <!--Javascripts includes goes here-->
    <?php 
        include '../includes/footer.php';
    ?>
	
	<!--Javascript external goes here-->
    <script type="text/javascript" language="javascript" src="../assets/vendors/bootstrap/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" language="javascript" src="../assets/vendors/DataTables/04_Admin_Paid&PendingFineTickets.js"></script>

	
	<script>
	
		/*View function*/
        $(document).ready(function () {
    $(document).on('click', '.view_data', function () {
        var ref_no = $(this).attr("id"); // Get the reference number
        if (ref_no != '') {
            $.ajax({
                url: "issued_fines_view_modal.php", // PHP file to fetch details
                method: "POST",
                data: { ref_no: ref_no },
                success: function (data) {
                    $('#fine_detail').html(data); // Populate modal with data
                    $('#dataModal').modal('show'); // Show the modal
                }
            });
        }
    });
});		
		

	//To close the success & error alert with slide up animation
	$("#success-alert").delay(4000).fadeTo(2000, 500).slideUp(1000, function(){
    	$("#success-alert").slideUp(1000);
	});

		
	</script>	

</body>

</html>
<?php
 mysqli_close($conn);
?>
<?php
}else{ 
	header("Location: index.php");
	exit();
}
?>
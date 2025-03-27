<?php
session_start();
if (isset($_SESSION['license_id']) && isset($_SESSION['driver_email']) && isset($_SESSION['driver_name']) && isset($_SESSION['home_address'])) {
?>


<!DOCTYPE html>
<html>

<head>
    <title>Driver's Paid Fine | Driver</title>

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
            <li class="leftsidebar-nav-item">
                <a href="dashboard.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-tachometer-alt"></i>
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
                <a href="pending_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <span>Driver's Violations</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="paid_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-coins"></i>
                    </div>
                    <span>Driver's Paid Fine</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_revenue.php" class="leftsidebar-nav-link">
                    <div>
                    <i class="fa fa-file-invoice"></i>
                    </div>
                    <span>View ROAD TAX</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                    <i class="fa fa-triangle-exclamation"></i>
                    </div>
                    <span>Fines & Violations</span>
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
                <h1 class="mt-4">Paid Fine</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Paid Fine</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> You can sort data here
                    </div>
                    <div class="card-body" >
                        <div class="table-responsive">
                            <!--Paid fine table includes goes here-->
                            <?php 
                                include 'paid_fine_table.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Dashboard main content end here ========================================-->
	
	<!--Popup modal includes goes here-->
    <?php 
        include 'includes/paid_fine_modal.php';
    ?>


    <!--Javascripts includes goes here-->
    <?php 
        include '../includes/footer.php';
    ?>
	
	<!--Javascript external goes here-->
    <script type="text/javascript" language="javascript" src="../assets/vendors/bootstrap/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script>
		
		/*View function*/
		$(document).ready(function(){        
			$(document).on('click', '.view_data', function(){  
			   var did = $(this).attr("id");  
			   if(did != '')  
			   {  
					$.ajax({  
						 url:"paid_fine_view_modal",  
						 method:"POST",  
						 data:{did:did},  
						 success:function(data){  
							  $('#driver_detail').html(data);  
							  $('#dataModal').modal('show');  
						 }  
					});  
			   }            
			});  
		});
		
	</script>

    <script type="text/javascript" language="javascript" src="../assets/vendors/DataTables/01_Driver_PendingFine&PaidFine.js"></script>


</body>

</html>
<?php
}else{ 
	header("Location: login.php");
	exit();
}
?>


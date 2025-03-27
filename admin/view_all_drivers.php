<?php
	   include "../connection.php";
	   $sql = "SELECT * FROM driver";
	   $result = mysqli_query($conn, $sql);  
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['admin_email'])) {
?>


<!DOCTYPE html>
<html>

<head>
    <title>View Drivers | TOFDS Admin</title>

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
                <h1 class="mt-4">View Drivers</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Drivers</li>
                </ol>
                <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> You can sort data here
                    </div>					
                    <div class="card-body">
                        <div class="table-responsive" id="employee_table">
                            <!--View Drivers table view goes here-->
                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
								<!--Alert box -->
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
								<thead>
									<tr>
										<th> Action</th>										
										<th>License ID</th>
										<th>Driver Email</th>
										<th>Driver Full Name</th>
										<th>License Issue Date</th>
										<th>License Expire Date</th>
									</tr>
								</thead>
								
								<tbody>
									<?php 
									  while($row = mysqli_fetch_array($result)) 
									  {
									?>
									<tr> 
										<td> <!--consider about row and res when edit button add-->	
											<button type="button" name="view" value="View" id="<?php echo $row["license_id"]; ?>" class="btn btn-info btn-xs view_data"><i class="fas fa-info-circle"></i></button>
											<button type="button" name="edit" value="Edit" id="<?php echo $row["license_id"]; ?>" class="btn btn-success btn-xs edit_data"><i class="fas fa-pen"></i></button>
											<button type="button" name="delete" value="Delete" id="<?php echo $row["license_id"]; ?>" class="btn btn-danger btn-xs delete_data"><i class="fas fa-trash-alt"></i></button>							
										</td>										
										<td><?php echo $row["license_id"] ?></td>
										<td><?php echo $row["driver_email"] ?></td>
										<td><?php echo $row["driver_name"] ?></td>
										<td><?php echo $row["license_issue_date"] ?></td>
										<td><?php echo $row["license_expire_date"] ?></td>
										
									</tr>
									<?php	
									  }
									?>
								</tbody>
							</table>
							
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Dashboard main content end here ========================================-->

    <!--View Drivers popup modals-->	
	
	<!--Popup modal for view more details-->
	<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<h4 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-user"></i>  Driver All Details</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="driver_detail">      
					<!-- Table content comes from view_all_drivers_view_modal.php-->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Popup modal for Edit function-->
	<div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-pen"></i> Edit Driver Details</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="../admin/view_all_drivers_edit_modal.php" id="insert_form" method="POST">
					<div class="form-group">
        <label for="license_id">License ID</label>
        <input type="text" id="license_id" name="did" class="form-control" value="<?php echo $license_id; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="driver_email">Driver Email</label>
        <input type="email" id="driver_email" name="driver_email" class="form-control" value="<?php echo $driver_email; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="driver_name">Driver Name</label>
        <input type="text" id="driver_name" name="driver_name" class="form-control" value="<?php echo $driver_name; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="license_issue_date">License Issue Date</label>
        <input type="date" id="license_issue_date" name="license_issue_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
		
    </div>
    <div class="form-group">
        <label for="license_expire_date">License Expire Date</label>
        <input type="date" id="license_expire_date" name="license_expire_date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+5 years')); ?>" readonly>
		<input type="hidden" id="license_expire_date" name="license_issue_date" value="<?php echo date('Y-m-d', strtotime('+5 years')); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
				</div>              
			</div>
		</div>
	</div>
	
	<!-- Popup modal for Delete function-->
	<div class="modal fade" id="deleteDriverDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Delete Driver Details</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" id="delete_form">  
						<h6>Are you sure want to delete this driver from the system?</h6>
						<div class="modal-footer">
							<button type="submit" name="del_confirm" id="del_confirm"  Value="Confirm" class="btn btn-danger">Confirm</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
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
	<script type="text/javascript" language="javascript" src="../assets/vendors/DataTables/03_MTD_ViewAllDrivers.js"></script>

	<script>
    // Automatically update the expire_date based on issue_date
    document.getElementById('license_issue_date').addEventListener('change', function () {
        const issueDate = new Date(this.value);
        const expireDate = new Date(issueDate);
        expireDate.setFullYear(issueDate.getFullYear() + 5); // Add one year to the issue date
        document.getElementById('license_expire_date').value = expireDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
    });
</script>

	<script>
	
	 /*Delete function
	  (document).on('click', '.delete_data', function(){  
           var did = $(this).attr("id");  
           $.ajax({  
                url:"../admin/view_all_drivers_delete_modal.php",  
                method:"POST",  
                data:{did:did},                
                success:function(data){
					$('#deleteDriverDetails').modal('show');
                      ('#driver_detail').html(data);
					 
					   ('#deleteDriverDetails').modal('hide');  
                       ('#employee_table').html(data);
					 
					   ('#insert').val("Confirm");
                       
                }  
           });   
      }); */
		$('#delete_form').on("submit", function(event){  
			event.preventDefault(); /*re-writing permission to table*/
			var did = $(this).attr("id");
			$.ajax({  
				url:"../admin/view_all_drivers_delete_modal.php",  
				method:"POST",
				data:{did:did},
				data:$('#insert_form').serialize(),  
				beforeSend:function(){  
					$('#insert').val("Inserting");  
				}, 
			success:function(data){ 					
					$('#deleteDriverDetails').modal('hide');  
					$('#employee_table').html(data);  
				}  
			}); 
		});
	  
	  /*Edit function*/  
      $(document).on('click', '.edit_data', function(){  
           var did = $(this).attr("id");  
           $.ajax({  
                url:"../admin/view_all_drivers_edit_modal_formdata.php",  
                method:"POST",  
                data:{did:did},  
                dataType:"json",  
                success:function(data){  
                     $('#license_id').val(data.license_id);  
                     $('#daddress').val(data.home_address);  
                     $('#driver_email').val(data.driver_email);  
                     $('#license_issue_date').val(data.license_issue_date);  
                     $('#license_expire_date').val(data.license_expire_date);  
                     $('#registered_date').val(data.registered_at);  
                     $('#class_of_vehicle').val(data.class_of_vehicle);  
                     $('#driver_name').val(data.driver_name);                      
                       
                     $('#did').val(data.license_id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#driver_email').val() == "")  
           {  
                alert("Email is required");  
           }  
           else if($('#daddress').val() == '')  
           {  
                alert("Address is required");  
           }
			else if($('#driver_name').val() == '')  
           {  
                alert("Driver Name is required");  
           }           
		   
           else  
           { 
                $.ajax({  
                     url:"../admin/view_all_drivers_edit_modal.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');
						  window.location = "./view_all_drivers.php?success=Driver details updated successfully";
						  //alert("Record removed successfully");
						  
                            ('#employee_table').html(data);  
                     }  
                });  
           }  
      }); 
		/*View function*/
		$(document).ready(function(){        
			$(document).on('click', '.view_data', function(){  
			   var did = $(this).attr("id");  
			   if(did != '')  
			   {  
					$.ajax({  
						 url:"../admin/view_all_drivers_view_modal.php",  
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
		
		/*delete test sample*/
		$(".delete_data").click(function(event){
			event.preventDefault();
        //var did = $(this).parents("tr").attr("id");
		var did = $(this).attr("id");  

		
        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url:"../admin/view_all_drivers_delete_modal.php",  
               type: "POST",
               data:{did:did},    
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                      ("#"+did).delete_data();
					  ('#employee_table').html(data);
					window.location = "./view_all_drivers.php?error=Record delete successfully from the system";                    
               }
            });
        }
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
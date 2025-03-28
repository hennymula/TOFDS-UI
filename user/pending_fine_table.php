<?php
if (isset($_SESSION['license_id']) && isset($_SESSION['driver_email']) && isset($_SESSION['driver_name']) && isset($_SESSION['home_address'])) {
?>



<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Action</th>
            <th>Reference No</th>
            <th>Provision</th>
            <th>Vehicle No</th>
            <th>Issue Date</th>
            <th>Expire Date</th>
            <th>Court Date</th>
            <th>ZMK</th>
        </tr>
    </thead>
   
    <tbody>
        <?php //Read details from issued_fine table
		include "../connection.php";	
        $license_id = $_SESSION['license_id'];	
		$sql=mysqli_query($conn,"select * from issued_fines where license_id = '$license_id' AND status='pending'");
		while($res=mysqli_fetch_assoc($sql))
		{		
		?>
        <tr>
            <td class="d-flex justify-content-start">  
                <button type="button" name="view" value="View" id="<?php echo $res["ref_no"]; ?>" class="btn btn-info btn-xs view_data"><i class="fas fa-info-circle"></i></button>
				<button type="button" name="paynow" value="Paynow" id="<?php echo $res["ref_no"]; ?>" class="btn btn-warning btn-xs pay_now">Pay Now <i class="fas fa-coins"></i></button>
			</td>

            <td><?php echo $res['ref_no']; ?></td>
            <td><?php echo $res['provisions']; ?></td>
            <td><?php echo $res['vehicle_no']; ?></td>
            <td><?php echo $res['issued_date']; ?></td>
            <td><?php echo $res['expire_date']; ?></td>
            <td><?php echo $res['court_date']; ?></td>
            <td><?php echo $res['total_amount']; ?></td>
        </tr>
        <?php 	
		}?>
    </tbody>
</table>

<?php
}else{ 
	header("Location: login.php");
	exit();
}
?>


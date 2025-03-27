 <?php  
  
 if(!empty($_POST))  
 {    
	  include "../connection.php";
      $output = '';  
      $message = '';  

      $license_id = mysqli_real_escape_string($conn, $_POST["did"]);  
	  $driver_email = mysqli_real_escape_string($conn, $_POST["driver_email"]);  
	  $driver_name = mysqli_real_escape_string($conn, $_POST["driver_name"]);  
      

      // Set license issue and expire dates
    $license_issue_date = date('Y-m-d'); // Current date
    $license_expire_date = date('Y-m-d', strtotime('+5 years')); // 5 years from now

    if (!empty($license_id)) {
     // Update query
     $query = "UPDATE driver SET 
             driver_email = '$driver_email',
             driver_name = '$driver_name',
             license_issue_date = '$license_issue_date',
             license_expire_date = '$license_expire_date' 
             WHERE license_id = '$license_id' ";

     // Debug the query
     // Uncomment the following line to debug the query
     // echo $query; exit();

     if (mysqli_query($conn, $query)) {
       header("Location: ../admin/view_all_drivers.php?success=Revenue License updated successfully!");
     exit();
     } else {
       header("Location: ../admin/view_all_drivers.php?error=Failed to Update Road Tax!");
       exit();
     }
 } else {
  header("Location: ../admin/view_all_drivers.php?error=Missing required fields!");
  exit();
 }


}
?>
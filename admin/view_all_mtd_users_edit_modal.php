<?php
// filepath: /Applications/MAMP/htdocs/TOFDS/admin/view_all_mtd_users_edit_modal.php
if (isset($_POST['mtd_id'])) {
    include "../connection.php";
    $output = '';  
    $message = '';
    $mtd_id = $_POST['mtd_id'];
    $mtd_email = mysqli_real_escape_string($conn, $_POST["mtd_email"]);   
    
    

    // Validate inputs
    if (empty($mtd_email)) {
        echo "Email is required!";
        exit();
    }

    if (!filter_var($mtd_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    // Update the email in the database
    $sql = "UPDATE mtd SET mtd_email = '$mtd_email' WHERE mtd_id = '$mtd_id'";
    if (mysqli_query($conn, $sql)) {
        echo "RATSA user email updated successfully!";
    } else {
        echo "Error updating email: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
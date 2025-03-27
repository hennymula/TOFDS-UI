<?php
session_start();
include "../connection.php";

if (isset($_POST['reference_no']) && isset($_POST['vehicle_no']) && isset($_POST['driver_name']) && isset($_POST['email']) && isset($_POST['issue_date']) && isset($_POST['expire_date'])) {
    $reference_no = $_POST['reference_no'];
    $vehicle_no = $_POST['vehicle_no'];
    $driver_name = $_POST['driver_name'];
    $email = $_POST['email'];
    $issue_date = $_POST['issue_date'];
    $expire_date = $_POST['expire_date'];

    // Update the revenue license in the database
    $query = "UPDATE revenue_license SET 
                vehicle_no = '$vehicle_no', 
                driver_name = '$driver_name', 
                email = '$email', 
                issue_date = '$issue_date', 
                expire_date = '$expire_date' 
              WHERE reference_no = '$reference_no'";
    if (mysqli_query($conn, $query)) {
        header("Location: check_revenue_license.php?success=Revenue License updated successfully!");
        exit();
    } else {
        header("Location: check_revenue_license.php?error=Failed to Update Road Tax!");
        exit();
    }
} else {
    header("Location: check_revenue_license.php?error=Missing required fields!");
    exit();
}
?>
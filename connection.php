<?php
// Include Composer's autoload.php
require_once __DIR__ . '/vendor/autoload.php';


$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "root";
$dbname = "stfms";

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Update status to "renew" if expire_date is less than the current date
$current_date = date('Y-m-d');
$update_query = "UPDATE revenue_license SET status = 'renew' WHERE expire_date < '$current_date'";
mysqli_query($conn, $update_query);
// Update status to "pending" if expire_date is less than the current date in issued_fines
$update_fines_pending_query = "UPDATE issued_fines SET status = 'pending' WHERE expire_date < '$current_date' AND (status IS NULL OR status = '')";
mysqli_query($conn, $update_fines_pending_query);

// Update status to "paid" if paid_date exists and status is "pending" in issued_fines
$update_fines_paid_query = "UPDATE issued_fines SET status = 'paid' WHERE paid_date IS NOT NULL AND status = 'pending'";
mysqli_query($conn, $update_fines_paid_query);
// Update status to "court order" if expire_date is earlier than the current date and status is "pending"
$update_fines_court_order_query = "UPDATE issued_fines SET status = 'court order' WHERE expire_date < '$current_date' AND status = 'pending'";
mysqli_query($conn, $update_fines_court_order_query);


?>
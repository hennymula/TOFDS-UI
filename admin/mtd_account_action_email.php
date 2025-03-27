<?php
session_start();
include "../connection.php";

if (isset($_POST['check-email'])) {
    $current_email = $_POST['currentemail'];

    // Validate email input
    if (empty($current_email)) {
        echo json_encode(['status' => 'error', 'message' => 'Email cannot be empty!']);
        exit();
    } elseif (!filter_var($current_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format!']);
        exit();
    } else {
        // Check if the email exists in the database
        $sql = "SELECT * FROM admin WHERE admin_email = '$current_email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Email exists!']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email does not exist!']);
            exit();
        }
    }
} elseif (isset($_POST['change-email'])) {
    $new_email = $_POST['newemail'];
    $current_email = $_POST['currentemail'];

    // Validate email input
    if (empty($new_email)) {
        header("Location: mtd_account.php?error=New email cannot be empty!");
        exit();
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: mtd_account.php?error=Invalid new email format!");
        exit();
    } else {
        // Update the email in the database
        $sql = "UPDATE admin SET admin_email = '$new_email' WHERE admin_email = '$current_email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: mtd_account.php?success=Email updated successfully!");
            exit();
        } else {
            header("Location: mtd_account.php?error=Failed to update email!");
            exit();
        }
    }
} else {
    header("Location: mtd_account.php");
    exit();
}
?>
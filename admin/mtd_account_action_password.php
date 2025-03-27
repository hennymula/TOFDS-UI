<?php
session_start();
include "../connection.php";

if (isset($_POST['change-password'])) {
    $new_password = $_POST['newpassword'];
    $password_confirm = $_POST['passwordconfirm'];

    // Validate password inputs
    if (empty($new_password) || empty($password_confirm)) {
        header("Location: mtd_account.php?error=Password fields cannot be empty!");
        exit();
    } elseif ($new_password !== $password_confirm) {
        header("Location: mtd_account.php?error=Passwords do not match!");
        exit();
    } else {
        // Hash the new password
        $hashed_password = md5($new_password);

        // Update the password in the database
        $sql = "UPDATE admin SET admin_password = '$hashed_password' WHERE id = '{$_SESSION['id']}'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: mtd_account.php?success=Password updated successfully!");
            exit();
        } else {
            header("Location: mtd_account.php?error=Failed to update password!");
            exit();
        }
    }
} else {
    header("Location: mtd_account.php");
    exit();
}
?>
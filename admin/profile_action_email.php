<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['admin_email'])) {
    include "../connection.php";

    if (isset($_POST['change-email'])) {
        $changeemail = trim($_POST['changeemail']);
        $changeemail = stripslashes($changeemail);
        $changeemail = htmlspecialchars($changeemail);
        $changeemail = strtolower($changeemail); // Normalize email to lowercase

        $user_data = 'changeemail=' . $changeemail;

        // Check if the email field is empty
        if (empty($changeemail)) {
            header("Location: profile.php?error=Admin Email is required!&$user_data");
            exit();
        }

        // Validate email format
        if (!filter_var($changeemail, FILTER_VALIDATE_EMAIL)) {
            header("Location: profile.php?error=Invalid email format!&$user_data");
            exit();
        }

        $admin_id = $_SESSION['id'];

        // Check if the new email already exists in the database for another admin
        $sql = "SELECT * FROM admins WHERE admin_email = '$changeemail' AND id != '$admin_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Email already exists
            header("Location: profile.php?error=Email already exists!&$user_data");
            exit();
        } else {
            // Update the email for the current admin
            $sql_update = "UPDATE admins SET admin_email = '$changeemail' WHERE id = '$admin_id'";
            if (mysqli_query($conn, $sql_update)) {
                header("Location: profile.php?success=Admin email changed successfully.");
                exit();
            } else {
                header("Location: profile.php?error=Failed to update email!&$user_data");
                exit();
            }
        }
    } else {
        header("Location: profile.php?error=Error Occurred.");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
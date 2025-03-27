<?php
// filepath: /Applications/MAMP/htdocs/TOFDS/admin/view_all_mtd_users_delete_modal.php
if (isset($_POST['did'])) {
    include "../connection.php";
    $mtd_id = $_POST['did'];

    $sql = "DELETE FROM mtd WHERE mtd_id = '$mtd_id'";
    if (mysqli_query($conn, $sql)) {
        echo "RATSA user deleted successfully!";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
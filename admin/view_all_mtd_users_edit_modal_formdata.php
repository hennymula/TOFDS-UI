<?php
// filepath: /Applications/MAMP/htdocs/TOFDS/admin/view_all_mtd_users_edit_modal_formdata.php
if (isset($_POST['did'])) {
    include "../connection.php";
    $mtd_id = $_POST['did'];

    $sql = "SELECT mtd_id, mtd_email FROM mtd WHERE mtd_id = '$mtd_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No data found']);
    }
    mysqli_close($conn);
}
?>
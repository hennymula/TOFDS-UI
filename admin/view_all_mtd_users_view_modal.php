<?php
// filepath: /Applications/MAMP/htdocs/TOFDS/admin/view_all_mtd_users_view_modal.php
if (isset($_POST['did'])) {
    include "../connection.php";
    $mtd_id = $_POST['did'];

    $sql = "SELECT * FROM mtd WHERE mtd_id = '$mtd_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <table class="table table-bordered">
            <tr>
                <th>MTD ID</th>
                <td><?php echo $row['mtd_id']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['mtd_email']; ?></td>
            </tr>
            <tr>
                <th>Registered Date</th>
                <td><?php echo $row['registered_at']; ?></td>
            </tr>
        </table>
        <?php
    } else {
        echo "<p>No details found for this user.</p>";
    }
    mysqli_close($conn);
}
?>
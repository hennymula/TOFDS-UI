<?php
include "../connection.php";

if (isset($_POST['ref_no'])) {
    $ref_no = $_POST['ref_no'];

    $query = "SELECT * FROM issued_fines WHERE ref_no = '$ref_no'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($result)) {
        ?>
        <table class="table table-bordered">
            <tr>
                <th>Reference No.</th>
                <td><?php echo $row['ref_no']; ?></td>
            </tr>
            <tr>
                <th>License ID</th>
                <td><?php echo $row['license_id']; ?></td>
            </tr>
            <tr>
                <th>Police ID</th>
                <td><?php echo $row['police_id']; ?></td>
            </tr>
            <tr>
                <th>Total Amount</th>
                <td><?php echo $row['total_amount']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $row['status']; ?></td>
            </tr>
        </table>
        <?php
    } else {
        echo "No details found.";
    }
}
?>
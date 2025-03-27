<?php
session_start();
include "../connection.php";

if (isset($_POST['reference_no']) && isset($_POST['vehicle_no'])) {
    $reference_no = $_POST['reference_no'];
    $vehicle_no = $_POST['vehicle_no'];

    // Fetch the current details of the revenue license
    $query = "SELECT * FROM revenue_license WHERE reference_no = '$reference_no' AND vehicle_no = '$vehicle_no'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $license = mysqli_fetch_assoc($result);
    } else {
        header("Location: check_revenue_license.php?error=Invalid Reference No or Vehicle No!");
        exit();
    }
} else {
    header("Location: check_revenue_license.php?error=Missing Reference No or Vehicle No!");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Road Tax | RATSA</title>
    <?php include_once '../includes/header.php'; ?>
</head>
<body>
    <div class="container mt-4">
        <h1>Update Road Tax</h1>
        <form action="update_revenue_license_action.php" method="POST">
            <input type="hidden" name="reference_no" value="<?php echo $license['reference_no']; ?>">
            <div class="form-group">
                <label for="vehicle_no">Vehicle No</label>
                <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="<?php echo $license['vehicle_no']; ?>" required>
            </div>
            <div class="form-group">
                <label for="driver_name">Owner Name</label>
                <input type="text" class="form-control" id="driver_name" name="driver_name" value="<?php echo $license['driver_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $license['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="issue_date">Issue Date</label>
                <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?php echo $license['issue_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="expire_date">Expire Date</label>
                <input type="date" class="form-control" id="expire_date" name="expire_date" value="<?php echo $license['expire_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
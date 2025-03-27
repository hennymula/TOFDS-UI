<?php
session_start();
if (isset($_SESSION['police_id']) && isset($_SESSION['officer_email']) && isset($_SESSION['officer_name']) && isset($_SESSION['police_station']) && isset($_SESSION['court'])) {
    include "../connection.php";

    $police_id = $_SESSION['police_id']; // Get police_id from session

    // Query to fetch issued fines where police_id matches and status is 'paid'
    $query = "SELECT ref_no, vehicle_no, license_id, issued_date, issued_time, total_amount, status 
              FROM issued_fines 
              WHERE police_id = '$police_id' AND status = 'paid'";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Driver Violation History | Traffic Police Officer</title>

    <!-- Elements inside the head tag -->
    <?php include_once '../includes/header.php'; ?>
</head>

<body class="overlay-scrollbar">

    <!-- Top navigation bar -->
    <?php include 'includes/topNav.php'; ?>

    <!-- Left sidebar navigation -->
    <div class="leftsidebar" id="sidebar">
        <ul class="leftsidebar-nav">
            <li class="leftsidebar-nav-item">
                <a href="dashboard.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="reminder.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa fa-bell"></i>
                    </div>
                    <span>Reminders</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="add_new_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <span>Add Violation</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="driver_past_fine.php" class="leftsidebar-nav-link active">
                    <div>
                        <i class="fas fa-history"></i>
                    </div>
                    <span>Driver Violation History</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="check_revenue_license.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <span>View Road Tax</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_reported_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <span>View Violations</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="profile.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa fa-gear"></i>
                    </div>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Left sidebar navigation end -->

    <!-- Dashboard main content -->
    <div class="dashwrapper">
        <div class="container-fluid">
            <h1 class="mt-4">Driver's Past Fines</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Driver's Past Fines</li>
            </ol>

            <!-- Display issued fines -->
            <div class="row">
                <div class="col-12">
                    <div class="mycard">
                        <div class="mycard-content">
                            <h5>Issued Fines (Paid)</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Vehicle No</th>
                                        <th>License ID</th>
                                        <th>Issued Date</th>
                                        <th>Issued Time</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['ref_no'] . "</td>";
                                            echo "<td>" . $row['vehicle_no'] . "</td>";
                                            echo "<td>" . $row['license_id'] . "</td>";
                                            echo "<td>" . $row['issued_date'] . "</td>";
                                            echo "<td>" . $row['issued_time'] . "</td>";
                                            echo "<td>" . $row['total_amount'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No paid fines found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>

<?php
} else {
    // Redirect to login page if session is not set
    header("Location: index.php");
    exit();
}
?>
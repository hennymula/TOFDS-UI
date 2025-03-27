<?php
session_start();
if (isset($_SESSION['license_id']) && isset($_SESSION['driver_email']) && isset($_SESSION['driver_name']) && isset($_SESSION['home_address'])) {
    include "../connection.php";
    $license_id = $_SESSION['license_id']; // Use license_id instead of user_id
    $driver_email = $_SESSION['driver_email']; // Use license_id instead of user_id
    $current_date = date('Y-m-d');

    // Fetch issued fines with status 'pending' or 'court order' for the logged-in user
    $fines_query = "SELECT issued_fines.ref_no, issued_fines.vehicle_no, issued_fines.expire_date, issued_fines.status, issued_fines.court
                    FROM issued_fines
                    WHERE issued_fines.license_id = '$license_id'
                    AND (issued_fines.status = 'pending' OR issued_fines.status = 'court order')";
    $fines_result = mysqli_query($conn, $fines_query);

    // Fetch revenue licenses with status 'renew' for the logged-in user
    $licenses_query = "SELECT vehicle_no, expire_date, status
                       FROM revenue_license
                       WHERE email = '$driver_email'
                       AND status = 'renew'";
    $licenses_result = mysqli_query($conn, $licenses_query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reminders | User</title>
    <?php include_once '../includes/header.php'; ?>
</head>

<body class="overlay-scrollbar">
    <?php include 'includes/topNav.php'; ?>

    <!-- Left sidebar navigation start here =============================================-->
    <div class="leftsidebar" id="sidebar">
       <ul class="leftsidebar-nav">
            <!--Left sidebar navigation items-->
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
                <a href="pending_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <span>Driver's Violations</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="paid_fine.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-coins"></i>
                    </div>
                    <span>Driver's Paid Fine</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_revenue.php" class="leftsidebar-nav-link">
                    <div>
                    <i class="fa fa-file-invoice"></i>
                    </div>
                    <span>View ROAD TAX</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                    <i class="fa fa-triangle-exclamation"></i>
                    </div>
                    <span>Fines & Violations</span>
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
            <!--Left sidebar navigation items-->
        </ul>
    </div>
    <!-- Left sidebar navigation end here ============================================-->

    <!-- Dashboard main content start here -->
    <div class="dashwrapper">
        <div class="container-fluid">
            <h1 class="mt-4">Reminders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Reminders</li>
            </ol>
            <div class="card mt-5 mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i> You can sort data here
                    </div>

                    <div class="card-body">
            <div class="table-responsive" id="employee_table">
            
                            <h5>Issued Fines</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Vehicle No</th>
                                        <th>Court</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($fine = mysqli_fetch_assoc($fines_result)) { ?>
                                        <tr>
                                            <td><?php echo $fine['ref_no']; ?></td>
                                            <td><?php echo $fine['vehicle_no']; ?></td>
                                            <td><?php echo $fine['court']; ?></td>
                                            <td><?php echo $fine['expire_date']; ?></td>
                                            <td><?php echo $fine['status']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <h5 class="mt-4">Revenue Licenses</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Vehicle No</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($license = mysqli_fetch_assoc($licenses_result)) { ?>
                                        <tr>
                                            <td><?php echo $license['vehicle_no']; ?></td>
                                            <td><?php echo $license['expire_date']; ?></td>
                                            <td><?php echo $license['status']; ?></td>
                                        </tr>
                                    <?php } ?>
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
    header("Location: index.php");
    exit();
}
?>
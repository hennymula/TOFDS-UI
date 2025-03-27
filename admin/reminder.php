<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['admin_email']) && isset($_SESSION['admin_name'])) {
    include "../connection.php";

    // Fetch expired issued fines
    $adminid = $_SESSION['id']; // Admin ID from session
    $current_date = date('Y-m-d');
    $expired_fines_query = "SELECT issued_fines.ref_no, issued_fines.vehicle_no, issued_fines.expire_date, issued_fines.status, issued_fines.court, driver.driver_email AS driver_email
                            FROM issued_fines
                            LEFT JOIN driver ON issued_fines.license_id = driver.license_id
                            WHERE issued_fines.expire_date < '$current_date'
                            AND (issued_fines.status IS NULL OR issued_fines.status = 'court order')";
    $expired_fines_result = mysqli_query($conn, $expired_fines_query);

    // Fetch revenue licenses with status set to 'renew'
    $expired_licenses_query = "SELECT vehicle_no, email, expire_date, status 
                               FROM revenue_license 
                               WHERE status = 'renew'";
    $expired_licenses_result = mysqli_query($conn, $expired_licenses_query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reminders | TOFDS Admin</title>
    <?php include_once '../includes/header.php'; ?>
</head>

<body class="overlay-scrollbar">
    <?php include 'includes/topNav.php'; ?>

  <!-- Left sidebar navigation start here =============================================-->
  <div class="leftsidebar" id="sidebar">
    <ul class="leftsidebar-nav">

            <!--Left sidebar navigation items-->
            <li class="leftsidebar-nav-item" >
            <a href="dashboard.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-tachometer-alt fas"></i>
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
            <a href="add_traffic_officer.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-address-card fas"></i>
                    </div>
                    <span>Add Traffic Officer</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
            <a href="view_all_traffic_officers.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-users-cog fas"></i>
                    </div>
                    <span>View Traffic Officers</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="mtd_account.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-building fas"></i>
                    </div>
                    <span>RATSA Account</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-receipt fas"></i>
                    </div>
                    <span>Fines & Violations</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_all_drivers.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-users fas"></i>
                    </div>
                    <span>View Drivers</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="paid_fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-check-double fas"></i>
                    </div>
                    <span>Paid Fine Tickets</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="pending_fine_tickets.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fa-pause fas"></i>
                    </div>
                    <span>Pending Fine Tickets</span>
                </a>
            </li>
            
            <li class="leftsidebar-nav-item">
        <a href="../admin/check_revenue_license.php" class="leftsidebar-nav-link">
            <div>
                <i class="fa-list fas"></i>
                    </div>
                    <span>View Road Tax</span>
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
            <!-- Reminders Section -->
           
           
            <div class="card-body">
            <div class="table-responsive" id="employee_table">
                           
                        <h5>Expired Fines</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Vehicle No</th>
                                        <th>Driver Email</th>
                                        <th>Court</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($fine = mysqli_fetch_assoc($expired_fines_result)) { ?>
                                        <tr>
                                            <td><?php echo $fine['ref_no']; ?></td>
                                            <td><?php echo $fine['vehicle_no']; ?></td>
                                            <td><?php echo $fine['driver_email']; ?></td>
                                            <td><?php echo $fine['court']; ?></td>
                                            <td><?php echo $fine['expire_date']; ?></td>
                                            <td><?php echo $fine['status']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <h5 class="mt-4">Expired Road Tax</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Vehicle No</th>
                                        <th>Email</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($license = mysqli_fetch_assoc($expired_licenses_result)) { ?>
                                        <tr>
                                            <td><?php echo $license['vehicle_no']; ?></td>
                                            <td><?php echo $license['email']; ?></td>
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
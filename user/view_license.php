<?php
session_start();
if (isset($_SESSION['driver_email'])) {
    include "../connection.php";

    $driver_email = $_SESSION['driver_email']; // Get driver_email from session

    // Query to fetch license details for the logged-in user
    $query = "SELECT license_no, driver_name, issue_date, expire_date, vehicle_class, status FROM driver_license WHERE email = '$driver_email'";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>

<head>
<?php include_once '../includes/header.php'; ?>
    <style>
        .license {
            border: 5px solid #0f3057;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            background-color: #f9f9f9;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .license h1 {
            font-size: 2rem;
            color: #0f3057;
            margin-bottom: 20px;
        }

        .license p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .license .details {
            margin-top: 20px;
            text-align: left;
            font-size: 1rem;
        }

        .license .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .license .details th, .license .details td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .license .details th {
            background-color: #0f3057;
            color: white;
        }

        .print-button {
            margin-top: 20px;
        }
    </style>
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
                <a href="../user/reminder.php" class="leftsidebar-nav-link">
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
                <a href="view_license.php" class="leftsidebar-nav-link">
                    <div>
                    <i class="fa fa-id-card"></i>
                    </div>
                    <span>View License</span>
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
    
    <title>View License</title>

    <div class="dashwrapper">
        <div class="container-fluid">
            <h1 class="mt-4">Driver's License</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Driver's License</li>
            </ol>

            <!-- License Details -->
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="license">
                    <h1>Driver's License</h1>
                    <p>This certifies that the following details pertain to the driver's license:</p>
                    <div class="details">
                        <table>
                            <tr>
                                <th>License No</th>
                                <td><?php echo $row['license_no']; ?></td>
                            </tr>
                            <tr>
                                <th>Driver Name</th>
                                <td><?php echo $row['driver_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <td><?php echo $row['issue_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Expire Date</th>
                                <td><?php echo $row['expire_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Vehicle Class</th>
                                <td><?php echo $row['vehicle_class']; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn btn-primary print-button" onclick="window.print()">Print License</button>
                </div>
            <?php
                }
            } else {
                echo "<p>No license details found.</p>";
            }
            ?>
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
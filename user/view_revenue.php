<?php
session_start();
if (isset($_SESSION['driver_email'])) {
    include "../connection.php";

    $driver_email = $_SESSION['driver_email']; // Get driver_email from session

    // Query to fetch revenue license details for the logged-in user
    $query = "SELECT vehicle_no, driver_name, expire_date, status FROM revenue_license WHERE email = '$driver_email'";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>

<head>
<?php include_once '../includes/header.php'; ?>
    <style>
        .certificate {
            border: 5px solid #0f3057;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            background-color: #f9f9f9;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .certificate h1 {
            font-size: 2rem;
            color: #0f3057;
            margin-bottom: 20px;
        }

        .certificate p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .certificate .details {
            margin-top: 20px;
            text-align: left;
            font-size: 1rem;
        }

        .certificate .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .certificate .details th, .certificate .details td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .certificate .details th {
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
    
    <title>View ROAD TAX</title>




    <div class="dashwrapper">
        <div class="container-fluid">
            <h1 class="mt-4">ROAD TAX</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">ROAD TAX</li>
            </ol>

            <!-- ROAD TAX Certificate -->
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="certificate">
                    <h1>Revenue License Certificate</h1>
                    <p>This certifies that the following vehicle has a genuine ROAD TAX:</p>
                    <div class="details">
                        <table>
                            <tr>
                                <th>Vehicle No</th>
                                <td><?php echo $row['vehicle_no']; ?></td>
                            </tr>
                            <tr>
                                <th>Driver Name</th>
                                <td><?php echo $row['driver_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Expire Date</th>
                                <td><?php echo $row['expire_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn btn-primary print-button" onclick="window.print()">Print Certificate</button>
                </div>
            <?php
                }
            } else {
                echo "<p>No ROAD TAX found.</p>";
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
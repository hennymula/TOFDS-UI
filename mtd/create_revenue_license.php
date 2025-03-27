<?php
include "../connection.php";

session_start();
if (isset($_SESSION['mtd_id']) && isset($_SESSION['mtd_email'])) {
    // Initialize variables
    $error = '';
    $success = '';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Query the database for the highest reference_no and increment it by 1
        $query = "SELECT MAX(reference_no) AS max_ref FROM revenue_license";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['max_ref']) {
            $reference_no = $row['max_ref'] + 1; // Increment the highest reference_no
        } else {
            $reference_no = 1111111; // Start from 1111111 if no records exist
        }

        // Get form data
        $vehicle_no = $_POST['vehicle_no'];
        $vehicle_type = $_POST['vehicle_type'];
        $fuel_type = $_POST['fuel_type'];
        $driver_name = $_POST['driver_name'];
        $email = $_POST['email'];
        $issue_date = $_POST['issue_date'];
        $expire_date = $_POST['expire_date'];

        // Validate inputs
        if (empty($vehicle_no) || empty($vehicle_type) || empty($fuel_type) || empty($driver_name) || empty($email) || empty($issue_date) || empty($expire_date)) {
            $error = "All fields are required!";
        } else {
            // Insert into the database
            $query = "INSERT INTO revenue_license (reference_no, vehicle_no, vehicle_type, fuel_type, driver_name, email, issue_date, expire_date) 
                      VALUES ('$reference_no', '$vehicle_no', '$vehicle_type', '$fuel_type', '$driver_name', '$email', '$issue_date', '$expire_date')";

            if (mysqli_query($conn, $query)) {
                $success = "Revenue license created successfully! Reference No: $reference_no";
            } else {
                $error = "Failed to create revenue license!";
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Road Tax | RATSA</title>

    <!-- Elements inside the head tag -->
    <?php 
        include_once '../includes/header.php';
    ?>
</head>

<body class="overlay-scrollbar">

    <!-- Top navigation bar -->
    <?php 
        include 'includes/topNav.php';
    ?>

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
                <a href="add_driver.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span>Add Driver</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="view_all_drivers.php" class="leftsidebar-nav-link">
                    <div>
                        <i class="fas fa-users"></i>
                    </div>
                    <span>View Drivers</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
                <a href="../mtd/create_revenue_license.php" class="leftsidebar-nav-link">
                    <div>
                       <i class="fas fa-edit"></i>
                    </div>
                    <span>Create Road Tax</span>
                </a>
            </li>
            <li class="leftsidebar-nav-item">
        <a href="../mtd/check_revenue_license.php" class="leftsidebar-nav-link">
            <div>
                <i class="fas fa-list"></i>
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
               </a>
            </li>
            <!--Left sidebar navigation items-->
        </ul>
    </div>
    <!-- Left sidebar navigation end here ============================================-->

    <!-- Main content -->
    <div class="dashwrapper animated fadeIn">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                <h1 class="mt-4">Create Road Tax</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Create Road Tax</li>
                </ol>

                <!-- Display success or error messages -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" id="success-alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error; ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success" id="success-alert">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success; ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Create Form -->
                <div class="card mb-4">
                    <div class="card-body p-lg-5">
                        <form action="../mtd/create_revenue_license.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="vehicle_no">Vehicle Plate Number</label>
                                    <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="Vehicle Plate Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="vehicle_type">Vehicle Type</label>
                                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Vehicle Type">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fuel_type">Fuel Type</label>
                                    <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Fuel Type">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="driver_name">Owner Name</label>
                                    <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Owner Name">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="issue_date">Issue Date</label>
                                    <input type="date" class="form-control" id="issue_date" name="issue_date">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="expire_date">Expire Date</label>
                                    <input type="date" class="form-control" id="expire_date" name="expire_date">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Road tax</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php 
        include '../includes/footer.php';
    ?>

    <script>
        // To close the success & error alert with slide-up animation
        $("#success-alert").delay(4000).fadeTo(2000, 500).slideUp(1000, function(){
            $("#success-alert").slideUp(1000);
        });
    </script>
</body>

</html>
<?php
} else { 
    header("Location: index.php");
    exit();
}
?>
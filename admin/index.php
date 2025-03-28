<!DOCTYPE html>
<html lang="en">

<head>
    <title>TOFDS Admin |  Login</title>
    <!--Meta tags start-->
    <meta charset="UTF-8">
    <meta name="description" content="TOFDS FINAL YEAR PROJECT">
    <meta name="keywords" content="Traffic, Offence, Fine, System, Mulungushi University">
    <meta name="author" content="Hendricks Mwape(201902471)">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <!--Meta tags end-->
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/vendors/bootstrap/bootstrap.min.css">
    <!--===============================================================================================-->
    <!-- Import fontawesome from CDN -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.css">
    <!-- End fontawesome from CDN -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/vendors/animatecss/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">
    <!--===============================================================================================-->
    <style>
        body{
            background-color: #00587a;
        }
    </style>


</head>

<body>
    <!--Login form start here--->
    <div class="container">
        <div class="row login-section">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body animated fadeIn">
                        <h1 class="card-icon"><i class="fas fa-user-shield"></i></h1>
                        <h5 class="card-title text-center">TOFDS Admin</h5>
                        <!--Warning msg start-->
                        <?php if (isset($_GET['error'])) { ?>
						<div class="alert alert-danger" id="success-alert">
						<i class="fas fa-exclamation-circle"></i>
						<?php echo $_GET['error']; ?>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				<?php } ?>
                <?php if (isset($_GET['success'])) { ?>
						<div class="alert alert-success" id="success-alert">
						<i class="fas fa-check-circle"></i>
						<?php echo $_GET['success']; ?>
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				<?php } ?>
                        <form class="form-signin" action="../admin/login_action.php" method="POST">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" name="admin_email" class="form-control" placeholder="Email address">
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" name="admin_password" class="form-control" placeholder="Password">
                            </div>
                            <button class="btn btn-lg btn-block text-uppercase" type="submit">Log in</button>
                            <hr class="my-4">
                            <h6 style="text-align: center; text-decoration: none;"><span><a href="forgot-password.php"><i class="fas fa-unlock-alt"></i> Forget Password?</a></span> <span class="ml-2"><a href="../gov.php"><i class="fas fa-home"></i> Home</a></span></h6>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Login form end here--->

    <!--===============================================================================================-->
    <script src="../assets/vendors/jquery/jquery-3.5.1.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/vendors/bootstrap/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script>
    	//To close the success & error alert with slide up animation
	$("#success-alert").delay(4000).fadeTo(2000, 500).slideUp(1000, function(){
    	$("#success-alert").slideUp(1000);
	});
    </script>


</body>

</html>
 
<div class="fixed-footer">
    <div style="margin-top:320px;">
    <center>  <p>©  <?php echo date("Y"); ?>
      Traffic Offence and Fine Detection System - A Final Year Project Developed By <span style="color: white">Hendricks Mwape(201902471)</span></p> </center>
    </div>
</div>

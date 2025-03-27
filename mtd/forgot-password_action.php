<?php
    // Connection Created Successfully
    include "../connection.php";
    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    session_start();

    // if forgot button will clicked
    if (isset($_POST['forgot_password'])) {
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        $emailCheckQuery = "SELECT code FROM mtd WHERE mtd_email = '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        if(empty($email)){
            header("Location: forgot-password.php?error=Email Address is required!");
            exit();
        }else{
              // if query run
        if ($emailCheckResult) {
            // if email matched
            if (mysqli_num_rows($emailCheckResult) > 0) {
                 // Fetch the existing code from the database
                 $row = mysqli_fetch_assoc($emailCheckResult);
                 $code = $row['code'];
 
                 // Send the verification code using PHPMailer
                 $mail = new PHPMailer(true);
 
                 try {
                     // Server settings
                     $mail->isSMTP();
                     $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                     $mail->SMTPAuth = true;
                     $mail->Username = 'tofds111@gmail.com'; // Your Gmail address
                     $mail->Password = 'yrde ukdz exmo usrg'; // Your Gmail password or app password
                     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                     $mail->Port = 587;
 
                     // Recipients
                     $mail->setFrom('tofds111@gmail.com', 'TOFDS'); // Sender's email and name
                     $mail->addAddress($email); // Recipient's email
 
                     // Content
                     $mail->isHTML(true);
                     $mail->Subject = 'Email Verification Code';
                     $mail->Body = "Your verification code is <strong>$code</strong>";
 
                     $mail->send();
                     header("location: verification-code.php?success=We've sent a verification code to your Email <br> $email");
                     exit();
                 } catch (Exception $e) {
                     header("location: forgot-password.php?error=Failed while sending code: {$mail->ErrorInfo}");
                     exit();
                 }
 
            }else{
                header("Location: forgot-password.php?error= Incorrect Email Address!");
                exit();
            }
        }else {
            header("location: forgot-password.php?error= Failed while checking email from database!");
            exit();
        }

        }
    }else{
        header("location: forgot-password.php");
        exit();
    }

?>

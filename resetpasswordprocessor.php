<?php
include 'connection.php';

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//echo "hello";

session_start();

if (isset($_POST['forgetpassword'])) {
    $email = $_POST['email'];
    $otp=rand();
    // echo $email;
    $checkemail="select email from users where email='$email'";
    $checkemail_run=mysqli_query($conn,$checkemail);
    $count=mysqli_num_rows($checkemail_run);
    if($count==1) {
        $name="Breather Farms";
        $subject="Password reset";
        $body='<div style="background-color: green;color: white;padding-bottom: 1rem;padding-left: 1rem;" class="body">
                    <h1>Breather farms</h1>
                    <p>We are writing this message because you requested a password reset</p>
                    <p>Your otp is '.$otp.'</p>
                     <a style="background-color: blue;color: white;text-decoration: none;padding: 0.5rem;" href="http://localhost/biddingnew/resetpassword.php?email='.$email.'&otp='.$otp.'&searchdetails=">Click here to reset yourpassword</a>
                </div>';


        $mail=new PHPMailer(true);
//    $mail->SMTPDebug=SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPAuth=true;

        $mail->Host="smtp.gmail.com";

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->Username="abukbt13@gmail.com";
        $mail->Password="rsaltaemqpgmtcxl";

//    $mail->setFrom($email,$name);
        $mail->addAddress($email,$name);
//        $mail->addAttachment(true);
        $mail->isHTML(true);
        $mail->Subject=$subject;
        $mail->Body=$body;
        $mail->send();
        if($mail->send()){

            $otp="update users set otp='$otp' where email='$email'";
            $otp_run=mysqli_query($conn,$otp);
            if($otp_run){
                session_start();
                $_SESSION['status'] = "Open you email and to reset the password?";
                header("location:forgetpassword.php");
            }
        }
        else{
            session_start();
            $_SESSION['status'] = "Something went wrong maybe network problem try again";

            header("location:forgetpassword.php");
        }
    }
    else{
        session_start();
        $_SESSION['status'] = "Email does not exist?";

        header("location:forgetpassword.php");
    }

}
if (isset($_POST['resetpassword'])) {
    $email=$_POST['email'];
    $otp=$_POST['otp'];

    $password =md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    if($password !== $confirmpassword) {
        session_start();
        $_SESSION['status'] = "Password do not match?";

        header("location:resetpasswordprocessor.php");
    }
    else{
        $changepassword = "UPDATE users SET password='$password' WHERE email='$email' and otp='$otp'";
        $changepassword_run=mysqli_query($conn,$changepassword);
        if($changepassword_run){
            session_start();
            $_SESSION['status'] = "Password changed successfully";

            header("location:signin.php");
        }
        else{
            session_start();
            $_SESSION['status'] = "Credentials does not match check try again to reset";
            header("location:resetpassword.php");
        }
    }

}
?>
<?php
include 'connection.php';
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['accept_bid'])){
    $bid_id=$_POST['bid_id'];
    $user_id=$_POST['user_id'];
    $item_name=$_POST['item_name'];
    $item_id=$_POST['item_id'];
    $bid_amount=$_POST['bid_amount'];


    $user="select * from users where user_id = $user_id";
    $user_run=mysqli_query($conn,$user);
    $users=mysqli_fetch_all($user_run,MYSQLI_ASSOC);
    foreach ($users as $user){
        $username=$user["username"];
        $email=$user["email"];
    }
    $name="Breather Farms";
    $subject="Item bidding";
    $body='<div style="background-color: green;color: white;padding-bottom: 1rem;padding-left: 1rem;" class="body">
                    <h1>Breather farms</h1>
                    <p>You bid was successfully accepted. You are requested to visit our office in Eldoret to pic you anila</p>
                    <p>Thank you for shopping with us.Breather farms we are there for you</p>
                    
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
    $mail->addAddress($email,$username);
//        $mail->addAttachment(true);
    $mail->isHTML(true);
    $mail->Subject=$subject;
    $mail->Body=$body;
    $mail->send();
    if($mail->send()) {
        $accepbid = "update biddings set status='1' where item_id='$item_id'";
        $accepbid_run = mysqli_query($conn, $accepbid);
        if ($accepbid_run) {
            $accepitem = "update items set status='1' where id='$item_id'";
            $accepitem_run = mysqli_query($conn, $accepitem);
            if ($accepitem_run) {
                $bidded = "insert into  bidded_items (item_id,price,item_name,user_id,bid_id) values('$item_id','$bid_amount','$item_name','$user_id','$bid_id')";
                $bidded_run = mysqli_query($conn, $bidded);
                session_start();
                $_SESSION['status'] = 'Bid was successfully processed';
                header("location:admindashboard.php");
            }

        }
    }
}
if(isset($_POST['restore_bid'])) {
    $item_id = $_POST['item_id'];
    echo $item_id;

    $restore="update biddings set status='0' where item_id='$item_id'";
    $restore_run=mysqli_query($conn,$restore);
    if($restore_run){
        $restore="update items set status='0' where id='$item_id'";
        $restore_run=mysqli_query($conn,$restore);
        if($restore_run){
            $cancelbid="delete from bidded_items where item_id='$item_id'";
            $cancelbid_run=mysqli_query($conn,$cancelbid);
            if($cancelbid_run){
                session_start();
                $_SESSION['bid'] = 'Bid was successfully Restored';
                header("location:admindashboard.php");
            }

        }

    }
}


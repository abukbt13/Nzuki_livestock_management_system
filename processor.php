<?php
include 'connection.php';
if (isset($_POST["register"])) {
session_start();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
//    $time = time();
    if ($password !== $password2){
//        session_start();
        $_SESSION['status'] = 'Password mismatch';
        header("Location:signup.php");
        die();
    }
    $sql2 = "select username from users where email='$email'";
    $result2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($result2);
    if ($username == "" || $password == "" || $email == "") {
        session_start();
        $_SESSION['status'] = 'All inputs are required';
        header("Location:signup.php");
    } else {

        if ($count2 > 0) {
            session_start();
            $_SESSION['status'] = 'Email already exist';
            header("Location:register2.php");
        } else {


            $save = "insert into users(username,email,password) values('$username','$email','$password')";
            $res = mysqli_query($conn, $save);
            if ($res) {
                $sql = "SELECT * from users WHERE  email = '$email'";
                $result = mysqli_query($conn, $sql);
                $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($users as $user) {
                    $user_id = $user['user_id'];
                    $role = $user['role'];
                    $username = $user['username'];
                }

                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role;

                header("location:dashboard.php");

            } else {
                session_start();
                $_SESSION['status'] = 'Something went wrong';
                header("location:signup.php");
            }
        }
    }
}
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "select username from users where email='$email' && password='$password'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if ($count) {
            $find = "select * from users where email='$email'";
            $retrieve = mysqli_query($conn, $find);
            $users = mysqli_fetch_all($retrieve, MYSQLI_ASSOC);

            foreach ($users as $user) {
                $uid = $user['id'];
                $role = $user['role'];
                $username = $user['username'];
            }
            if ($role == 0) {
                //the password was correct
                session_start();
                $_SESSION['uid'] = $uid;
                $_SESSION['status'] = 'welcome back';
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                header("location:index.php");

            } else {
                session_start();
                $_SESSION['uid'] = $uid;
                $_SESSION['status'] = 'welcome back';
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                header("location:Admin/index.php");
            }
        } else {
            session_start();
            $_SESSION['status'] = "The credentials does not match";

            header("Location:signin.php");



        }

    }
if (isset($_POST['bid'])) {

    session_start();
    if(!isset($_SESSION['user_id'])){
//        echo 'knjnjk';
        $_SESSION['status']='Login in first to be able to make bid';
        header('Location:products.php');
        die();
    }
   $user_id=$_SESSION['user_id'];
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $bid_amount = $_POST['bid_amount'];
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];


    $check_bid="select * from biddings where user_id = $user_id and item_id =$item_id ";
    $check_bid_run=mysqli_query($conn,$check_bid);
        $bids=mysqli_num_rows($check_bid_run);
    if($bids>0){
        $_SESSION['status'] = 'You can not bid twice';
        header('Location:products.php');
        die();
    }
    $date = date('d-m-y');
    $time = date('H:i:s');
    if ($bid_amount < $min_price) {
        $_SESSION['status'] = 'The amount is too low';
        header('Location:products.php');
    }
    if ($bid_amount >= $max_price) {
        $_SESSION['status'] = 'The amount is too high';
        header('Location:products.php');
    }

    $save = "insert into biddings(user_id,item_name,item_id,bid_amount,time,date) values('$user_id','$item_name','$item_id','$bid_amount','$time','$date')";
    $res = mysqli_query($conn, $save);
    if($res){

        $items="select * from items where id = $item_id";
        $items_run = mysqli_query($conn,$items);
        foreach ($items_run as $item);


       $itembidders=$item['bidders'];
       $itembiddersnew=$itembidders+1;


        $peoplebid="update items set bidders='$itembiddersnew' where id='$item_id'";
        $peoplebid_run=mysqli_query($conn, $peoplebid);
        if($peoplebid_run){
            $_SESSION['status'] = 'You have successfully bidded for the product ';
            header('Location:products.php');
        }

    }

}
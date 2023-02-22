

<?php
session_start();
include('connection.php');
if(!isset($_SESSION['user_id'])) {
    header('Location:signin.php');
}

//$uid=$_SESSION['uid'];

if(isset($_SESSION['user_id'])) {

    session_destroy();
    header('location:signin.php');
}
else{
    header('location:signin.php');
}


?>

<?php
include 'connection.php';
if(isset($_POST['accept_bid'])){
    $bid_id=$_POST['bid_id'];
    $user_id=$_POST['user_id'];
    $item_name=$_POST['item_name'];
    $item_id=$_POST['item_id'];
    $bid_amount=$_POST['bid_amount'];


    echo $item_id;
    echo '<br>';
    echo $bid_id;
    $accepbid="update biddings set status='1' where item_id='$item_id'";
    $accepbid_run=mysqli_query($conn,$accepbid);
    if($accepbid_run) {
        $accepitem="update items set status='1' where id='$item_id'";
        $accepitem_run=mysqli_query($conn,$accepitem);
        if($accepitem_run){
            $bidded="insert into  bidded_items (item_id,price,item_name,user_id,bid_id) values('$item_id','$bid_amount','$item_name','$user_id','$bid_id')";
            $bidded_run=mysqli_query($conn,$bidded);
            session_start();
            $_SESSION['status'] = 'Bid was successfully processed';
            header("location:admindashboard.php");
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


<?php
include 'connection.php';
if(isset($_POST['accept_bid'])){
    $bid_id=$_POST['bid_id'];
    $bid="select * from biddings where id='$bid_id'";
    $bid_run=mysqli_query($conn,$bid);
    $items= mysqli_fetch_all($bid_run, MYSQLI_ASSOC);

    foreach ($items as $item) {
        $item_id = $item['item_id'];
    }
    echo $item_id;
    echo '<br>';
    echo $bid_id;
    $accepbid="update biddings set status='1' where id='$bid_id'";
    $accepbid_run=mysqli_query($conn,$accepbid);
    if($accepbid_run) {
        $accepitem="update items set status='1' where id='$item_id'";
        $accepitem_run=mysqli_query($conn,$accepitem);
        if($accepitem_run){
            session_start();
            $_SESSION['status'] = 'Bid was successfully processed';
            header("location:admindashboard.php");
        }

    }

}


<?php
session_start();
include 'connection.php';
$user_id=$_SESSION['user_id'];
$role= $_SESSION['role'];
if($role!=1){
    $_SESSION='Not allowed ';
    header('Location:dashboard.php?');
}
?>
<?php include 'header.php'; ?>
<div class="row mx-4 align-items-center justify-content-center" id="bids_content">
    <div class="active d-flex justify-content-between align-items-center">
       <h3>Active  Bids</h3>
        <a href="/reports/activebids.php" class="btn btn-success">Generate report</a>
    </div>
    <table class="table-bordered table-hover ">
        <tr>
            <th>id</th>
            <th>User id</th>
            <th>Item Name</th>
            <th>Bid amount</th>
            <th>Date</th>
            <th>time</th>
            <th class="text-center">Actions</th>
        </tr>

        <?php

        $items="select * from biddings where status = '0'";

        $items_run=mysqli_query($conn,$items);
        while($posts=mysqli_fetch_assoc($items_run)) {
            ?>

            <tr>
                <td><?php echo $posts['id']?></td>
                <td><?php echo $posts['user_id']?></td>
                <td><?php echo $posts['item_name']?></td>

                <td><?php echo $posts['bid_amount']?></td>
                <td><?php echo $posts['time']?></td>
                <td><?php echo $posts['date']?></td>

                <td>
                    <form action="bidprocessor.php" method="post">

                        <input type="number" name="user_id" hidden="" value="<?php echo $posts['user_id']?>">
                        <input type="text" name="item_name" hidden="" value="<?php echo $posts['item_name']?>">
                        <input type="number" name="item_id" hidden="" value="<?php echo $posts['item_id']?>">
                        <input type="number" name="bid_amount" hidden="" value="<?php echo $posts['bid_amount']?>">
                        <input type="number" name="bid_id" hidden="" value="<?php echo $posts['id']?>">
                        <button  class="btn btn-primary mx-1 my-1" type="submit" name="accept_bid" id="edit"> <i class="fa fa-cancel" aria-hidden="true"></i>
                            Accept
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>


    </table>
</div>
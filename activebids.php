
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
<div class="bids" id="bids_content">
    <div class="active">
        <h2>Active  Bids</h2>
    </div>
    <table>
        <tr>
            <th>id</th>
            <th>Item id</th>
            <th>User id</th>
            <th>Item Name</th>
            <th>Bid amount</th>
            <th>Date</th>
            <th>time</th>
            <th>Actions</th>
        </tr>

        <?php

        $items="select * from biddings where status = '0'";

        $items_run=mysqli_query($conn,$items);
        while($posts=mysqli_fetch_assoc($items_run)) {
            ?>

            <tr>
                <td><?php echo $posts['id']?></td>
                <td><?php echo $posts['item_id']?></td>
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
                        <button type="submit" name="accept_bid" id="edit" style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-cancel" aria-hidden="true"></i>
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
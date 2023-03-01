
<?php
session_start();
include 'connection.php';
$user_id=$_SESSION['user_id'];
$role= $_SESSION['role'];
if($role!=1){
    header('Location:dashboard.php?');
}
?>
<?php include 'header.php'; ?>
<div class="processedbids" id="bids_processedbids">
    <div class="processed">
        <h2>Processed Bids</h2>
    </div>
    <table>
        <tr>
            <th>id</th>
            <th>item_id</th>
            <th>bid_id</th>
            <th>Item Name</th>
            <th>Bidded price</th>
            <th>User Id</th>
        </tr>

        <?php

        $items="select * from bidded_items";

        $items_run=mysqli_query($conn,$items);
        while($posts=mysqli_fetch_assoc($items_run)) {
            ?>

            <tr>
            <tr>
                <td><?php echo $posts['id']?></td>
                <td><?php echo $posts['item_id']?></td>
                <td><?php echo $posts['bid_id']?></td>

                <td><?php echo $posts['item_name']?></td>
                <td><?php echo $posts['price']?></td>
                <td><?php echo $posts['user_id']?></td>

                <td>
                    <form action="bidprocessor.php" method="post">
                        <input type="number" name="item_id" hidden="" value="<?php echo $posts['item_id']?>">
                        <button type="submit" name="restore_bid" id="edit" style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-cancel" aria-hidden="true"></i>
                            Restore bid
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>


    </table>
</div>

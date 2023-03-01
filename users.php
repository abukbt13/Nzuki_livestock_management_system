
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
<div class="users" id="users_details">
    <h2>users View </h2>
    <table>
        <tr>
            <th>id</th>
            <th>User Name</th>
            <th>Location</th>
            <th>Phone</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php

        $items="select * from users where status='1'";

        $items_run=mysqli_query($conn,$items);
        while($posts=mysqli_fetch_assoc($items_run)) {
            ?>

            <tr>
                <td><?php echo $posts['user_id']?></td>
                <td><?php echo $posts['username']?></td>

                <td><?php echo $posts['town']?></td>
                <td><?php echo $posts['phone']?></td>
                <td>
                    <form action="">
                        <button>Delete</button>
                    </form>
                </td>


            </tr>
            <?php
        }
        ?>


    </table>
</div>
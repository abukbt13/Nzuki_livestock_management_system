<?php
session_start();
if(!isset($_SESSION['user_id'])){
    $_SESSION['status']="Login first  to be able view this page";
    header('Location:signin.php');
}
include 'connection.php';
include "header.php";
$user_id=$_SESSION['user_id'];
$user_details="select * from users where user_id='$user_id'";
$user_details_run=mysqli_query($conn,$user_details);
foreach($user_details_run as $user)
    $username=$user['username'];
    $phone=$user['phone'];
    $town=$user['town'];
?>
<div class="container">
    <style>
        .container{
            display: flex;
            flex-direction: row;
            background:rgba(25,15,255,0.2);
            height:85vh;
        }

    </style>
    <div class="sidebar" style="background-color: #00cec9;">
        <div class="profile" style="display: flex;margin-left:1rem;margin-top:1rem;">
            <img src="" height="55" width="55" style="border-radius: 50%;">
            <p>Nzuki Bryther</p>
        </div>


        <div class="contents">
            <button id="mybids" style="background:blue;color:white;border:none;outline-color:pink;margin:1rem;padding:0.5rem;font-size:17px;">
                Active Bids
            </button>
            <br>
            <button style="background:blue;color:white;border:none;outline-color:pink;margin:1rem;padding:0.5rem;font-size:17px;">
                Success Bids
            </button>
            <br>

        </div>


    </div>
    <div class="main-content" style="display:flex;flex-direction:column;align-items: center;margin-left: 2rem">
       <div class="details">
           <form action="processor.php">
               <p>My profile Info</p>

               <img src="" alt="profile pic" width="200" height="200">
               <p>Change profile pic</p>
               <input type="file" name="photo"><br>
               <label for="">User Name</label><br>
               <input type="text" name="username" value="<?php echo $username; ?>"><br>
               <label for="">Nearest Home town</label><br>
               <input type="text" name="username" value="<?php echo $town; ?>"><br>
               <label for="">Phone Number</label><br>
               <input type="text" name="username" value="<?php echo $phone; ?>"><br>
               <button type="submit" name="profile">Update profile infor</button>
           </form>
       </div>
        <h2>My bids</h2>
        <div class="bids">
            <table>
                <tr>
                    <th>id</th>
                    <th>Item Name</th>
                    <th>Bid amount</th>
                    <th>Date</th>
                    <th>time</th>
                    <th colspan="2">Actions</th>
                </tr>

                <?php

                $items="select * from biddings where user_id ='$user_id'";

                $items_run=mysqli_query($conn,$items);
                while($posts=mysqli_fetch_assoc($items_run)) {
                    ?>

                    <tr>
                        <td><?php echo $posts['id']?></td>
                        <td><?php echo $posts['item_name']?></td>

                        <td><?php echo $posts['bid_amount']?></td>
                        <td><?php echo $posts['time']?></td>
                        <td><?php echo $posts['date']?></td>
                        <td>
                            <button id="edit" style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-cancel" aria-hidden="true"></i>Cancel Bid</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>


            </table>
        </div>
    </div>
</div>

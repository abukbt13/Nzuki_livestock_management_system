<?php


include 'connection.php';
session_start();
$uid=$_SESSION['uid'];


if(isset($_POST['update_profile'])) {
    $newusername = $_POST['username'];
    $newtown = $_POST['town'];
    $newphone = $_POST['phone'];
    $profile = $_FILES['profile']['name'];
    $profiletmp = $_FILES['profile']['tmp_name'];
    $profile_new_name = rand() . $profile;

    $update = "update users set profile_image='$profile_new_name', username='$newusername',town='$newtown',phone='$newphone' where user_id='$uid'";
    $update_run = mysqli_query($conn, $update);
    if ($update_run) {
        session_start();
        move_uploaded_file($profiletmp, "profiles/" . $profile_new_name);
        echo "Upload successful";
        $_SESSION['status'] = 'Profile details updated successfully';
        header('Location:dashboard.php');
        die();
    }

}
if(isset($_POST['cancel'])){
    $item_id = $_POST['item_id'];
    $delete_query = "DELETE FROM biddings WHERE id = '$item_id' AND user_id = '$user_id'";
    $delete_query=mysqli_query($conn, $delete_query);
    if ($delete_query){
        session_start();
        $_SESSION['status'] = 'You have cancelled the bid';
        header('Location:dashboard.php');
    }

}
?>

<?php
include "header.php";
echo $uid;
?>
<div class="container">
    <style>
        .container{
            display: flex;
            flex-direction: row;
            background:rgba(25,15,255,0.2);
            height:85vh;
        }
        li{
            list-style: none;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
            padding: 0.4rem;
        }
        a{
            text-decoration: none;
            padding: 0.4rem;
        }
        a:hover{
            background: #0a58ca;
            color: white;
        }
        .top1, .top2 ,.top3{
            display: flex;
            justify-content: space-between;
        }
        .details{

            left: 11rem;
            padding: 2rem;
            background-color: rgb(85, 55, 15);
            padding-bottom: 1rem;
            width:50vw;
            display: none;

        }
        .active{
            display: block;
        }

    </style>
    <div class="sidebar" style="background-color: #00cec9;">
        <div class="profile" style="margin-left:1rem;margin-top:1rem;">
            <p><?php echo $uname; ?></p>

            <img style='border-radius: 50%;' src='profiles/<?php echo$profile ;?>' alt='Uploadprofile' width='100' height='100'>";




        </div>


        <div class="contents">
            <li id="profile"><a href="">View My profile</a></li>
            <li><a href="">Active bids</a></li>
            <li><a href="">Successful bids</a></li>

        </div>


    </div>
    <div class="" id="">

        <form action="dashboard.php" method="post" enctype="multipart/form-data">
            <p>My profile Info</p>
            <div class="top1">
                <img style="border-radius: 50%;" src="profiles/<?php echo $profile; ?>" alt="profiles pic" width="100" height="100">
                <div class="div">
                    <p>Change profile pic</p>
                    <input type="file" name="profile"><br>
                </div>
            </div>
            <div class="top2">
                <div class="div">
                    <label for="">User Name</label><br>
                    <input type="text" name="username" value="<?php echo $name; ?>"><br>

                </div>
                <div class="di">
                    <label for="">Nearest Home town</label><br>
                    <input type="text" name="town" value="<?php echo $town; ?>"><br>
                </div>
            </div>
            <div class="top3">
                <div class="div">
                    <label for="">Phone Number</label><br>
                    <input type="number" required name="phone" value="<?php echo $phone; ?>"><br>
                </div>
                <div class="div">
                    <br>
                    <button type="submit" name="update_profile" >Update profile infor</button>

                </div>
            </div>

        </form>
    </div>

    <div class="bids">
        <h2>My bids</h2>
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

            $items="select * from biddings where user_id ='$uid'";

            $items_run=mysqli_query($conn,$items);
            while($posts=mysqli_fetch_assoc($items_run)) {
                ?>

                <tr>
                    <td><?php echo $posts['id']?></td>
                    <td><?php echo $posts['item_name']?></td>

                    <td><?php echo $posts['bid_amount']?></td>
                    <td><?php echo $posts['date']?></td>
                    <td><?php echo $posts['time']?></td>
                    <td>
                        <form action="dashboard.php" method="post">
                            <input type="text" hidden="" name="item_id" value="<?php echo $posts['id']?>">
                            <button type="submit"  style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;" name="cancel"> Cancel Bid</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>


        </table>
    </div>
</div>

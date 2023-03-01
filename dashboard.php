<?php
session_start();
if (!isset($_SESSION['uid'])){
    session_start();
    $_SESSION['status'] = 'lOGIN TO VIEW THIS PAGE';
    header('Location:signin.php');
}

$uid=$_SESSION["uid"];
$role=$_SESSION["role"];
//echo $uid;
include "connection.php";
$user="select * from users where user_id=$uid";
$user_run=mysqli_query($conn,$user);
$num=mysqli_num_rows($user_run);

$users=mysqli_fetch_all($user_run,MYSQLI_ASSOC);
foreach ($users as $user){
    $username=$user["username"];
    $phone=$user["phone"];
    $town=$user["town"];
    $profile_image=$user["profile_image"];
}

if(isset($_POST['update_profile'])) {
    $newusername = $_POST['username'];
    $newtown = $_POST['town'];
    $newphone = $_POST['phone'];

    $initialpicture = $_POST['image'];


    $profile = $_FILES['profile']['name'];
    $profiletmp = $_FILES['profile']['tmp_name'];
    $profile_new_name = rand() . $profile;

    $path="profiles/";
    $fullpath=$path.$initialpicture;


    if(empty($profile)){

        $update = "update users set  username='$newusername',town='$newtown',phone='$newphone' where user_id='$uid'";
        $update_run = mysqli_query($conn, $update);
        if ($update_run) {
            session_start();
            $_SESSION['status'] = 'Profile details updated successfully';
            header('Location:dashboard.php');
            die();
        }
    }
    else{


        $update = "update users set profile_image='$profile_new_name', username='$newusername',town='$newtown',phone='$newphone' where user_id='$uid'";
        $update_run = mysqli_query($conn, $update);
        if ($update_run){
            session_start();
            move_uploaded_file($profiletmp,"profiles/".  $profile_new_name);
            unlink($fullpath);

            $_SESSION['status'] = "Profile Updated";
            header("Location:dashboard.php");
        }

    }

}
if(isset($_POST['cancel'])){
    echo 'hey';
    $item_id = $_POST['item_id'];
    $delete_query = "DELETE FROM biddings WHERE id = '$item_id' AND user_id = '$uid'";
    $delete_query=mysqli_query($conn, $delete_query);
    if ($delete_query){
        session_start();
        $_SESSION['status'] = 'You have cancelled the bid';
        header('Location:dashboard.php');
    }

}
include 'header.php';
//echo $username;
?>

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
    

</style>

<div class="container">

    <div class="sidebar" style="background-color: #00cec9;">
        <div class="profile" style="margin-left:1rem;margin-top:1rem;">
            <p><?php echo $username; ?></p>

            <img style='border-radius: 50%;' src='profiles/<?php echo$profile_image ?>' alt='Uploadprofile' width='100' height='100'>




        </div>


        <div class="contents">
            <li id="profile"><a href="">View My profile</a></li>
            <li><a href="">Active bids</a></li>
            <li><a href="">Successful bids</a></li>

        </div>
    </div>

        <div class="profile_details" id="">
            <style>
                .profile_details{
                    display: flex;
                    justify-content: center;
                    /*align-items: center;*/
                    padding-top: 1rem;
                    width: 24rem;
                    height: 100vh;
                    background: #ddd;
                    position: absolute;
                    top: 7rem;
                    left: 14rem;
                }
                .inputs{
                    text-align: center;
                    width: 100%;
                    border:none;
                    background:#ddd;
                    border-bottom: 1px solid #eee;
                    outline-style: none;
                    color: blue;
                    font-size: 20px;
                }
            </style>

            <form action="dashboard.php" method="post" enctype="multipart/form-data">
                <input type="text" name="image" value="<?php echo $profile_image; ?>">
                <div class="main">
                <h2 style="text-align: center;">Edit profile Info</h2>
                <div class="" style="display: flex;align-items: center;justify-content: center;">
                    <img style="border-radius: 50%;" src="profiles/<?php echo $profile_image; ?>" alt="profiles pic" width="100" height="100">
               </div>
                    <div class="i">
                        <p style="text-align: center; font-size: 17px;text-transform: uppercase;">Change profile pic</p>
                        <input class="inputs"  type="file" name="profile">
                    </div>
                <div class="">
                    <div class="div">
                        <p style="text-align: center; font-size: 17px;text-transform: uppercase;">User Name</p>
                        <input class="inputs"  type="text" name="username" value="<?php echo $username; ?>">

                    </div>
                    <div class="">
                        <p style="text-align: center; font-size: 17px;text-transform: uppercase;">Nearest Home town</p>

                        <input type="text" class="inputs"   name="town" value="<?php echo $town; ?>">
                    </div>
                </div>
                <div class="">
                    <div class="div">
                        <p style="text-align: center; font-size: 17px;text-transform: uppercase;">Phone Number</p>
                        <input  class="inputs"  type="number" required name="phone" value="<?php echo $phone; ?>"><br>
                    </div>
                    <div class="div">
                        <br>
                        <button type="submit" style="border-radius18px; padding-bottom:1rem;padding-top:1rem;border: 1px solid blue;background: blue;color: white; text-transform: uppercase;" class="inputs"  name="update_profile" >Update profile</button>

                    </div>
                </div>
                </div>
            </form>
        </div>

    <div class="bids" style="display:none;">
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
</div>
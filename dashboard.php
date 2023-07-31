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
?>


<div class="body">
    <style>
        .body{
            height: 90vh;
            background-color:#DED8D7;
            /* padding:0rem 0rem 0rem 2rem; */
        }
        .main_content{
            background-color: #FFFF;
            height:89vh;

        }
        .sidebar{
            width:16rem;
            height: 190vh;
            background-color: #fff3cd;
        }
        .sidebar li:hover{
            background: grey;
            color: white;
            padding: 0.4rem;
        }
        .contents li{
            padding:0.2rem 0.2rem 0.2rem 0.2rem;
            margin:0rem 2rem 0rem 0rem;
            font-size: 16px;
            text-transform: uppercase;
        }
        .contents li:hover{
            background-color: #DED8D7;
            border-radius: 8px;
        }
        .content{
            display: flex;
            flex-direction: column;
            /* width: 100%; */
        }
        .profile_content{
            display: none;
            width: 43rem;
            border:solid 1px #faa;
        }
        .bids{
            display:none;
        }
        .successbids{
            display:none;
        }
        .block{
            display: block;
        }
        .content .index .content{
            /*background-color: black;*/
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 1rem;
            padding: 1rem;
        }
    </style>
<div class="main_content d-flex">
    <div style="margin-bottom: 2rem;" id="sidebar" class="sidebar  d-none d-md-block d-lg-block">
        <p style="text-align: center; margin-left: 1rem;padding-top:0.5rem;text-transform: uppercase;">Dashboard</p>
        <hr>
        <div class="profile d-flex flex-column justify-content-center align-items-center">
            <img style='border-radius: 50%;' src='profiles/<?php echo$profile_image ?>' alt='No image' width='150' height='150'>
            <p style="text-align: center; margin-left: 1rem;margin-top: 1rem;text-transform: uppercase;"><?php echo $username; ?></p>
        </div>
        <hr>
        <div class="mb-3 ms-3">
            <li  class="list-unstyled my-2" ><a href="dashboard.php" class="text-decoration-none">Home</a></li>
            <li id="profile" class="list-unstyled my-2" id="profile"><a class="text-decoration-none">Profile</a></li>

            <li id="bids" class="list-unstyled my-2" id="profile"><a class="text-decoration-none">Active Bids</a></li>
            <li id="successbids" class="list-unstyled mb-4" id="profile"><a class="text-decoration-none" >Successfull Bids</a></li>

        </div>
    </div>
    <div class="content">
        <i style="font-size: 29px;" id="bar" class="d-block d-md-none d-lg-none fa fa-arrow-circle-left" aria-hidden="true"></i>
        <div style="display: flex; justify-content: center;" class="index index " id="index">
                    <div class="content">
                        <p class="text-center">Active bids</p>
                        <p class="text-center"><?php  $items="select * from biddings where user_id ='$uid' and status=0";

                            $items_run=mysqli_query($conn,$items);
                            $activebids=mysqli_num_rows($items_run);
                            echo $activebids
                            ?></p>
                    </div>
                    <div class="content">
                        <p class="text-center">Success Bids</p>
                        <p class="text-center"><?php  $items="select * from biddings where user_id ='$uid' and status=1";

                            $items_run=mysqli_query($conn,$items);
                            $activebids=mysqli_num_rows($items_run);
                            echo $activebids
                            ?></p>
                    </div>

            </div>

        <div id="profile_content" class="profile_content">
              <div class="container text-center">
                  <form  action="dashboard.php" method="post" enctype="multipart/form-data">

                  <div class="row border">
                    <div class="col border">
                        <div class="row">
                            <div class="col">
                                <h2 style="text-align: center;">Edit profile Info</h2>
                                <div class="" style="display: flex;align-items: center;justify-content: center;">
                                    <img style="border-radius: 50%;" src="profiles/<?php echo $profile_image; ?>" alt="profiles pic" width="100" height="100">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col border d-flex flex-column justify-content-center align-items-center">
                        <p>My profile Name</p>
                        <input class="inputs"  type="text" name="username" value="<?php echo $username; ?>">
                    </div>
                 </div>
                <div class="row border">
                    <div class="col border d-flex  flex-column justify-content-center align-items-center">
                        <p>Nearest Town</p>
                        <input type="text" class="inputs"   name="town" value="<?php echo $town; ?>">
                    </div>
                    <div class="col border d-flex  flex-column justify-content-center align-items-center">
                       <p>Phone Number</p>
                        <input  class="inputs"  type="number" required name="phone" value="<?php echo $phone; ?>"><br>

                    </div>

                </div>
                <div class="row border">

                    <div class="col">
                        <div class="form-group d-flex align-items-center flex-column m-2">
                            <p>Upload new Profile image</p>
                            <input class="inputs" class="form-control" type="file" name="profile">
                        </div>
                    </div>
                    <div class="col border d-flex justify-content-center align-items-center">
                        <buttton type="submit" name="update_profile" class="btn btn-primary">Update profile</buttton>
                    </div>
                </div>
                  </form>

            </div>
        </div>

        </div>
        <div id="bids_content" class="bids">

            <table  class="table table-bordered table-hover m-3">
                <tr>
                    <th>id</th>
                    <th>Item Name</th>
                    <th>Bid amount</th>
                    <th>Date</th>
                    <th>time</th>
                    <th colspan="2">Actions</th>
                </tr>

                <?php

                $items="select * from biddings where user_id ='$uid' and status =0";

                $items_run=mysqli_query($conn,$items);
                $activebids=mysqli_num_rows($items_run);
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
                                <button type="submit" class="btn btn-outline-info btn-primary" name="cancel"> Cancel Bid</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>


            </table>

        </div>
        <div id="success_bids" class="successbids">

            <table  class="table table-bordered table-hover">
                <tr>
                    <th>Item Name</th>
                    <th>Bid amount</th>
                    <th>Date</th>
                    <th>time</th>
                </tr>

                <?php

                $items="select * from biddings where user_id ='$uid' and status =1";

                $items_run=mysqli_query($conn,$items);
                while($posts=mysqli_fetch_assoc($items_run)) {
                    ?>

                    <tr>
                        <td><?php echo $posts['item_name']?></td>

                        <td><?php echo $posts['bid_amount']?></td>
                        <td><?php echo $posts['date']?></td>
                        <td><?php echo $posts['time']?></td>

                    </tr>
                    <?php
                }
                ?>


            </table>

        </div>

    </div>
</div>


</div>
<script>
    const index=document.getElementById("index");
    const profile=document.getElementById("profile");
    const profile_content=document.getElementById("profile_content");
    profile.addEventListener('click', ()=>{

        profile_content.style.display="block";
        index.style.display="none";
        bids_content.style.display="block";
        success_bids.style.display="none";
        bids_content.style.display="none";
        sidebar.classList.toggle("d-none");
    })
    const bids=document.getElementById("bids")
    const bids_content=document.getElementById("bids_content")
    bids.addEventListener('click', ()=>{
        bids_content.style.display="block";
        index.style.display="none";
        success_bids.style.display="none";
        profile_content.style.display="none";
        sidebar.classList.toggle("d-none");

    })
    const successbids=document.getElementById("successbids")
    const success_bids=document.getElementById("success_bids")
    successbids.addEventListener('click', ()=>{
        success_bids.style.display="block";
        index.style.display="none";
        bids_content.style.display="none";
        profile_content.style.display="none";
        sidebar.classList.toggle("d-none");

    })
    const bar=document.getElementById("bar")
    const sidebar=document.getElementById("sidebar")
    bar.addEventListener('click', ()=>{
        sidebar.classList.toggle("d-none");
        index.classList.toggle("flex-column");
    })
</script>
</div>
<?php

session_start();
include 'header.php';
include 'connection.php';
if (!isset($_SESSION['uid'])){
    session_start();
    $_SESSION['status'] = 'lOGIN TO VIEW THIS PAGE';
    header('Location:signin.php');
}

$uid=$_SESSION["uid"];
$role=$_SESSION["role"];
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
?>
<style>
    label{
        font-size: 20px;
    }
</style>

<div style="height: 100vh; width: 100vw" class="profile d-flex justify-content-center align-items-center">
    <div class="inside">
        <form  action="profile.php" method="post" enctype="multipart/form-data">

                            <h2 style="text-align: center;">Edit profile Info</h2>
                            <div class="" style="display: flex;align-items: center;justify-content: center;">
                                <img style="border-radius: 50%;" src="profiles/<?php echo $profile_image; ?>" alt="profiles pic" width="100" height="100">
                            </div>

            <div class="form-group">
                <label for="">
                    My profile Name
                </label>
                <input class="form-control"  type="text" name="username" value="<?php echo $username; ?>">
            </div>
             <div class="form-group">
                 <label for="">
                     Nearest Town
                 </label>
                    <input type="text"  class="form-control" name="town" value="<?php echo $town; ?>">
                </div>
                 <div class="form-group">
                     <label for="">
                         Phone Number
                     </label>
                        <input  class="form-control"  type="number"  required name="phone" value="<?php echo $phone; ?>">
                 </div>

                <div class="form-group">
                    <label for="">
                        Upload new Profile image
                    </label>
                    <input class="mb-2 form-control" type="file" name="profile">
                </div>
            <input type="submit" class="btn btn-primary" value="update profile" name="update_profile">
            </div>

        </form>
    </div>
</div>

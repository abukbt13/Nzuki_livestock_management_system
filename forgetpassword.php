<?php

session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<style>
  .main{
      width: 15rem;
      background-color: rgb(123,22,222);
      padding: 2rem;
  }
  .main_content{
      display: grid;
      justify-content: center;
      align-items: center;
      width: 100vw;
      height: 100vh;
  }
</style>
<p>  <?php
    if(isset($_SESSION['status'])){
    ?>
<div>
    <h2><?php echo $_SESSION['status']; ?></h2>
</div>
<?php
unset($_SESSION['status']);
}
?>
</p>
<div class="main_content"><div class="main">
<div class="nav" style="display: flex;justify-content: space-between; padding-bottom: 1rem;">
    <a style="color: white;background-color: blue;" href="../login.php">Go Back</a>
    <a style="color: white;background-color: blue;" href="../create_account.php">Create account</a>

</div>
 <div class="forget">

        <form action="resetpasswordprocessor.php" method="post">
            <label for="Email" STYLE="font-size: 23px;">Enter the Email you registered with</label><br><br>
            <input type="email" style=" height: 2rem;width: 100%;" name="email" placeholder="Enter email"><br><br>
            <button type="submit" style="margin-left:2rem; " name="forgetpassword">Click To Reset Password</button>
        </form>
    </div>
</div>
</div>

</body>
</html>
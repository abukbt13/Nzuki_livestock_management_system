<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="style.css">
    </head>
    <body style="background-image:url('Images/login-background.jpg');background-size: cover;">
        <div class="container">
            <form action="processor.php" method="post">


                <div class="container hide-me">
                    <?php
                    session_start();
                    if(isset($_SESSION['status'])){
                        ?>
                        <div>
                            <p style="padding: 1rem; font-size: 22px;background-color: red; color: white;"><?php echo $_SESSION['status']; ?> ?</p>
                        </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                    ?>
                    <form method="post" action="processor.php">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                            <input type="password" name="password2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>


                        <button type="submit" name="register" class="btn btn-primary">Signup </button>
                        <p>Already have an account </p>
                        <a class="btn btn-secondary " href="signin.php">Click here to  Login</a>

                    </form>


            </div>
        </div>
    </body>
</html>

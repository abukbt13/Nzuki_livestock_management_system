<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body style="background-image:url('Images/login-background.jpg');background-size: cover;">
        <div class="container">
            <div class="container form bg-white pt-5 mt-4 mb-3">
                <form action="processor.php" method="post">
                <p class="text-center text-white">login here</p>
                <?php
                session_start();
                if(isset($_SESSION['status'])){
                    ?>
                    <div>
                        <p class="text-white btn-danger p-2"><?php echo $_SESSION['status']; ?> ?</p>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                }
                ?>
                    <form method="post" action="processor.php">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <a class="" href="forgetpassword.php">Don't remember password?</a><br>
                        <button type="submit" name="login" class="btn btn-primary">Submit</button>
                    </form>
                    <a class="" href="signup.php">Dont have an Account</a><br>
                </div>
            </div>
        </div>
    </body>
</html>

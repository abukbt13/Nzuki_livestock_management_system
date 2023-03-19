<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <?php include 'header.php'; ?>
    <body style="background-image:url('Images/login-background.jpg');background-size: cover;background-color: white;height: 90vh;">
        <div class="row d-flex align-items-center justify-content-center">

            <div  style="width: 23rem;" class="form bg-white pt-5 mt-4 mb-3 rounded">
                <form action="processor.php" method="post">
                    <h2 style="text-align: center; border-bottom: 2px solid grey;">Login Here</h2>
                <?php
                session_start();
                if(isset($_SESSION['status'])){
                    ?>
                    <div>
                        <p class="text-white bg-danger btn-danger p-2"><?php echo $_SESSION['status']; ?> ?</p>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                }
                ?>
                    <form method="post" action="processor.php">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="login" class="btn btn-primary">Submit</button>
                            <a class="btn btn-primary" href="forgetpassword.php">Don't remember password?</a>
                        </div>
                    </form>
                    <p class="text-center text-uppercase" > <a  href="signup.php">Dont have an Account?</a></p>
            </div>
            </div>
        </div>
    </body>
</html>

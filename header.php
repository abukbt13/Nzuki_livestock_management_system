<?php
//session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php 
        if(isset($title)){
            echo $title;
        }
        else{
            echo "bidding system";
        }
        ?>
    </title>
    <link rel="shortcut icon" type="image" href="cow.jpeg" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/app.js"></script>
</head>
<body>
<style>
    .head{
        padding-left: 1rem;
        background: antiquewhite;
        display: flex;
        justify-content: space-between;
        height: 3rem;
    }
    .ul{
        display: flex;
    }

    .ul li{
        list-style: none;
        margin-right: 1rem;
        font-size: 22px;
    }
    .ul li a{
        padding: 0.5rem;
        text-decoration: none;
    }
    .ul li a:hover{
        background: blue;
        color: white;
    }
    .show{
        display: none;
        position: absolute;
        top: 0.2rem;
        right: 0.2rem;
        color: #0a58ca;
    }
    @media screen and (max-width: 500px) and (min-width: 200px) {
        .show{
            display: block;
        }
        .head{
            display: flex;
            flex-direction: column;
            padding-left: 0rem;
            position: relative;
        }
        .ul{
            position: relative;
            display: flex;
            top: -6rem;
            color:white;
            align-items: center;
            justify-content: center;
            width: 100vw;
            /*transition-property: top;*/
            transition-duration: 0.5s;
            transition-timing-function: ease-in;
        }
        .ul li {
            background:antiquewhite;
            list-style: none;
            margin-right: 0rem;
        }
        .ul li a {
            margin-left:0.4rem;
            background-color: blue;
            color: white;
        }
        .active{
            top: 0rem;
            right:1rem;
        }

    }</style>
<div class="head">
    <h3><a href="index.php">BRYTHER FARMS</a></h3>
    <ul class="ul" id="links" class="links">
        <li><a href="products.php">Products</a></li>

        <?php

        if (isset($_SESSION['role'])) {
            $role=$_SESSION['role'];
            if($role==1){
                echo '<li><a href="admindashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';

            }
            else{
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';

            }

        }
        else{
            echo '<li><a href="signin.php">LOGIN</a></li>';

        }
        ?>
    </ul>
    <span class="my-2 show" id="show"> <i class="fa fa-bars"></i> </span>


</div>

<script>
    const show=document.getElementById('show');
    const links=document.getElementById('links');
    show.addEventListener('click', () => {
        links.classList.toggle('active');
    });
</script>
</body>
</html>
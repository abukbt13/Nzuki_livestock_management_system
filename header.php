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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<style>
    .head{
        padding-left: 1rem;
        background: antiquewhite;
        display: flex;
        justify-content: space-between;
        
    }
    .ul{
        display: flex;
        text-decoration: none;
        list-style: none;
    }
    .ul li{
        margin-right: 1rem;
        font-size: 22px;
    }
    .ul a{
        padding: 0.5rem;
        text-decoration: none;
    }
    .ul a:hover{
        background: blue;
        color: white;
    }
</style>
<div class="head">
    <h3><a href="index.php">BRYTHER FARMS</a></h3>
    <ul class="ul">
        <li><a href="products.php">Products</a></li>
        <?php if (isset($_SESSION['user_id'])){
            echo '<li><a href="dashboard.php">Dashboard</a></li>';
            echo '<li><a href="admindashboard.php">AdminDashboard</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        else{
            echo '<li><a href="signin.php">Login/Sign up</a></li>';
        }
        ?>


    </ul>

</div>


</body>
</html>
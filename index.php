<?php
session_start();


include 'connection.php';
include 'header.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home </title>
    <link rel="shortcut icon" href="https://www.example.com/my-logo.png">
    <link rel="shortcut icon" href="bid.webp"></head>
<body>
<style>
    .main-content{
        display: flex;
        flex-direction: row;
        width: 100%;
    }
    .picture{
        border-radius: 18px;
        width: 60%;
        background-image:url("cds.jpeg");
        background-size: cover;
        color: beige;
    }
    .content-items{
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 37rem;
    }
    .content-items p{
        margin-left: 1rem;
        margin-right: 1rem;
        font-size:20px;
        text-align: center;
    }
    @media screen and (max-width: 500px) and (min-width: 200px) {
        .picture{
            display: none;
        }
    }
</style>
<div class="main-content">
                <div class="picture">
                </div>
                <div class="content-items">
                    <span style="font-size: 28px;">About us</span>
                    <p>

                            A bidding farm that deals with livestock is a type of agricultural
                        operation where farmers come together to buy and sell different types of animals.
                        These farms often specialize in raising and caring
                        for a specific type of livestock, such as cows, pigs, chickens,
                        or sheep. <br>
                        The bidding process at these farms allows farmers to compete for the
                        animals they want to purchase, driving up the price and ensuring that the
                        animals are sold for a fair market value. The bidding process also ensures that
                        the animals are sold to the farmer who can provide the best care and resources
                        for them.
                        <br>At a bidding farm, the livestock are well-cared for and are subject to regular
                        health checks to ensure their well-being. These farms play an important role in the agriculture
                        industry, helping farmers to build their herds and supplying the market with high-quality,
                        healthy animals..


                    </p>

                </div>
</div>
<hr>
<?php include'footer.php'; ?>
</body>
</html>

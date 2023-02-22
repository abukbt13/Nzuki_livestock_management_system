<?php
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
</head>
<body>
<style>
    .main-content{
        display: flex;
        flex-direction: row;
        width: 100%;
        height:90vh
    }
    .picture{

        width: 60%;
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
        font-size:21px;
    }
</style>
<div class="main-content">
                <div class="picture">
                    <p>Cow image</p>
                    <img src="cow.jpeg" alt="" width="220" height="220">
                </div>
                <div class="content-items">
                    <h2>About us</h2>
                    <p>
                        <b>                        A bidding farm that deals with livestock is a type of agricultural
                        operation where farmers come together to buy and sell different types of animals.
                        These farms often specialize in raising and caring
                        for a specific type of livestock, such as cows, pigs, chickens,
                        or sheep. The bidding process at these farms allows farmers to compete for the
                        animals they want to purchase, driving up the price and ensuring that the
                        animals are sold for a fair market value. The bidding process also ensures that
                        the animals are sold to the farmer who can provide the best care and resources
                        for them. At a bidding farm, the livestock are well-cared for and are subject to regular
                        health checks to ensure their well-being. These farms play an important role in the agriculture
                        industry, helping farmers to build their herds and supplying the market with high-quality,
                        healthy animals..
                        </b>

                    </p>

                </div>
</div>
<?php include'footer.php'; ?>
</body>
</html>

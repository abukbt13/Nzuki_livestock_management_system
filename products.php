<?php
session_start();
include 'connection.php';
$title='Product view';
include 'header.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
<style>
    .prod_box{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    img{
        width: 100%;

        height: 21rem;
    }
    .sessionmsg{
        position: absolute;
        top: 4rem;
        left:4rem;
        background: red;
        padding:1rem;
        border: solid 1px red;
        border-radius: 18px;
        color: white;
    }

</style>
<?php
if(isset($_SESSION['status'])){
    ?>
    <div>
        <div class="sessionmsg">
            <div class="msg">
                <p><?php echo $_SESSION['status'] ?></p>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION['status']);
}
?>
        <div class="prod_box">
                <?php
                $items="select * from items where status ='0'";
                $itemsrun=mysqli_query($conn,$items);

                while($posts=mysqli_fetch_assoc($itemsrun)) {
                    ?>
                    <form onsubmit="yourFunction(); return false;" action="processor.php" method="post">
                    <div class="item" style="padding: 9px;">
                        <p><?php echo $posts['item_name']?></p>
                        <img src="items/<?php echo $posts['photo']?>" alt="product">
                       <div class="bid">
                           <bid-details style="display: flex; justify-content: space-between;"><p>Enter Your bid</p> <p>People bidding <span style="border-radius: 50%;padding: 2px; padding-left: 3px;padding-right: 3px; background: blue;color: white;"><?php echo $posts['bidders']?></span></p></bid-details>
                           <input type="number" hidden="" name="item_id" value="<?php echo $posts['id']?>">
                           <input type="text" hidden="" name="item_name" value="<?php echo $posts['item_name']?>">
                           <input type="number"  name="min_price" value="<?php echo $posts['min_price']?>">
                           <input type="number" hidden="" name="max_price" value="<?php echo $posts['max_price']?>">
                           <input type="number" name="bid_amount"  placeholder="Enter you bid here">
                            <button type="submit" name="bid">Place Bid</button>
                       </div>
                        <br> <br>
                    </div>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>




<?php include'footer.php'; ?>
</body>
</html>

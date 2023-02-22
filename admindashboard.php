<?php
session_start();
include 'connection.php';
$user_id=$_SESSION['user_id'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<style>
    .container-main{
        width: 96vw;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        height: 100vh;
    }
    .head{
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        display: flex;
        background-color: #4EA0F9;
        justify-content: space-between;
    }
    .contents{
        display: flex;
        flex-direction:row;
        width: 96%;
    }
    .sidebar{
        width: 22%;
        background:#E4E1E7;
        height: 100vh;
    }
    .content_area{
        width: 100%;
        height: 100vh;
    }

    .sidebar ul{

    }
    .sidebar ul li{
            list-style: none;
    }
    .sidebar ul li i{
        margin: 1rem;
    }
    .product{
        display: none;
        width: 100%;
        height: 99vh;
        background: #4EA0F9;
        overflow: scroll;
    }
    .bids{
        display: none;
    }
    .processedbids{
        display: none;
    }
    .users{
        display: none;
    }
    .system{
        display: none;
    }
    .show{
        display: block;
    }
</style>
<div class="container-main">
    <div class="head">
        <p><a href="index.php">BRYTHER FARMS</a></p>
        <p>Administrator<i class="fa fa-caret-down" style="color: white;margin-left: 0.7rem; " aria-hidden="true"></i></p>
    </div>
    <div class="contents">
        <div class="sidebar">
            <ul>
                <li id="category"> <i class="fa fa-home" aria-hidden="true"></i>Home</li>
                <li  id="product"> <i class="fa fa-th-list" aria-hidden="true"></i>Products</li>
                <li  id="bids"> <i class="fa fa-btc" aria-hidden="true"></i>Active Bids</li>
                <li  id="processedbids"> <i class="fa fa-btc" aria-hidden="true"></i>Processed Bids</li>
                <li  onclick="showUsers()"> <i class="fa fa-user" aria-hidden="true"></i>Users</li>

            </ul>
        </div>
        <div class="content_area">
            <div class="sidebar-content" id="sidebar_content">
                <h2>hello world</h2>
            </div>
            <div class="product" id="product_content">
                    <?php include 'admin/product.php'; ?>
            </div>
            <div class="bids" id="bids_content">
                <div class="active">
                    <h2>Active  Bids</h2>
                </div>
                <table>
                    <tr>
                        <th>id</th>
                        <th>Item Name</th>
                        <th>Bid amount</th>
                        <th>Date</th>
                        <th>time</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                    $items="select * from biddings where status = '0'";

                    $items_run=mysqli_query($conn,$items);
                    while($posts=mysqli_fetch_assoc($items_run)) {
                        ?>

                        <tr>
                            <td><?php echo $posts['id']?></td>
                            <td><?php echo $posts['item_name']?></td>

                            <td><?php echo $posts['bid_amount']?></td>
                            <td><?php echo $posts['time']?></td>
                            <td><?php echo $posts['date']?></td>

                            <td>
                                <form action="bidprocessor.php" method="post">
                                    <input type="number" name="bid_id" hidden="" value="<?php echo $posts['id']?>">
                                <button type="submit" name="accept_bid" id="edit" style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-cancel" aria-hidden="true"></i>
                                    Accept
                                </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>


                </table>
            </div>
            <div class="processedbids" id="bids_processedbids">
                <div class="processed">
                    <h2>Processed Bids</h2>
                </div>
                <table>
                    <tr>
                        <th>id</th>
                        <th>Item Name</th>
                        <th>Bid amount</th>
                        <th>Date</th>
                        <th>time</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                    $items="select * from biddings where status = '1'";

                    $items_run=mysqli_query($conn,$items);
                    while($posts=mysqli_fetch_assoc($items_run)) {
                        ?>

                        <tr>
                            <td><?php echo $posts['id']?></td>
                            <td><?php echo $posts['item_name']?></td>

                            <td><?php echo $posts['bid_amount']?></td>
                            <td><?php echo $posts['time']?></td>
                            <td><?php echo $posts['date']?></td>

                            <td>
                                <form action="bidprocessor.php" method="post">
                                    <input type="number" name="bid_id" hidden="" value="<?php echo $posts['id']?>">
                                <button type="submit" name="accept_bid" id="edit" style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-cancel" aria-hidden="true"></i>
                                    Restore bid
                                </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>


                </table>
            </div>
            <div class="users" id="users_details">
                    <h2>users View </h2>
                <table>
                    <tr>
                        <th>id</th>
                        <th>User Name</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th colspan="2">Actions</th>
                    </tr>

                    <?php

                    $items="select * from users where status='0'";

                    $items_run=mysqli_query($conn,$items);
                    while($posts=mysqli_fetch_assoc($items_run)) {
                        ?>

                        <tr>
                            <td><?php echo $posts['user_id']?></td>
                            <td><?php echo $posts['username']?></td>

                            <td><?php echo $posts['town']?></td>
                            <td><?php echo $posts['phone']?></td>
                            <td>
                                <form action="">
                                    <button>Delete</button>
                                </form>
                            </td>


                        </tr>
                        <?php
                    }
                    ?>


                </table>
            </div>

        </div>
    </div>
</div>
<script>
    function showUsers(){
      const  users_details=document.getElementById("users_details");
        users_details.classList.add('show');
        bids_processedbids.classList.remove('show');
        bids_content.classList.remove('show');
        sidebar_content.style.display="none";
        product_content.classList.remove('show');
    }
</script>
<script>
    const processedbids=document.getElementById("processedbids");
    const bids_processedbids=document.getElementById("bids_processedbids");

    processedbids.addEventListener('click',() => {
        // alert("Product")
        bids_processedbids.classList.add('show');
        users_details.classList.remove('show');
        bids_content.classList.remove('show');
        sidebar_content.style.display="none";
        product_content.classList.remove('show');
    })
</script>
<script>
    //products
    const product=document.getElementById("product");
    const sidebar_content=document.getElementById("sidebar_content");

    product.addEventListener('click',() => {
        product_content.classList.add('show');
        users_details.classList.remove('show');
        bids_processedbids.classList.remove('show');
        bids_content.classList.remove('show');
        sidebar_content.style.display="none";

    })

</script>

<script>
    const bids=document.getElementById("bids");
    const bids_content=document.getElementById("bids_content");
    bids.addEventListener('click',() => {
        bids_content.classList.add('show');
        product_content.classList.remove('show');
        users_details.classList.remove('show');
        bids_processedbids.classList.remove('show');
        sidebar_content.style.display="none";
    })

</script>
</body>
</html>

<?php
session_start();
include 'connection.php';
$user_id=$_SESSION['user_id'];
$role= $_SESSION['role'];
if($role!=1){
    header('Location:dashboard.php?');
}
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
<?php include'header.php'; ?>
<div class="container-main">

    <div class="contents">
        <div class="sidebar">
            <ul>
                <li id="category"> <i class="fa fa-home" aria-hidden="true"></i>Home</li>
                <li > <i class="fa fa-th-list" aria-hidden="true"></i><a href="uploadproduct.php">Products</a></li>
                <li > <i class="fa fa-btc" aria-hidden="true"></i><a href="activebids.php">Active bids</a></li>
                <li > <i class="fa fa-btc" aria-hidden="true"></i><a href="processedbids.php">Processed bids</a></li>
                <li> <i class="fa fa-user" aria-hidden="true"></i><a href="users.php">Users</a></li>

            </ul>
        </div>
        <div class="content_area">
            <div class="sidebar-content" id="sidebar_content">
                <?php
                if(isset($_SESSION['bid'])){
                    ?>
                    <div>
                            <div class="bg-danger">
                                <p class="text-center padding 0.5rem"><?php echo $_SESSION['bid'] ?></p>
                            </div>
                        </div>
                    <?php
                    unset($_SESSION['bid']);
                }
                ?>
                <div class="admin-content d-flex gap-3 justify-content-center mt-4">
                    <div class="products bg-info w-25">
                        <p class="text-center"><i style="font-size: 30px;padding-top: 2rem;" class="fa fa-product-hunt" aria-hidden="true"></i>    </p>
                        <p class="text-center">PRODUCTS</p>
                        <div class="contents d-flex flex-column justify-content-center ms-1 ">
                            <p class="text-center"><a href="uploadproduct.php" class="text-decoration-none">view products</a></p>
                            <button class="btn btn-primary my-3">Generate Report</button>
                        </div>
                    </div>

                    <div class="products bg-info w-25">
                        <p class="text-center"><i style="font-size: 30px;padding-top: 2rem;" class="fa fa-btc" aria-hidden="true"></i>    </p>
                        <p class="text-center">Bids</p>
                        <div class="contents d-flex flex-column justify-content-center ms-1 ">
                            <p class="text-center"><a href="activebids.php" class="text-decoration-none">view active bids</a></p>
                            <button class="btn btn-primary my-3">Generate Report</button>
                        </div>
                    </div>

                    <div class="products bg-info w-25">
                        <p class="text-center"><i style="font-size: 30px;padding-top: 2rem;" class="fa fa-users" aria-hidden="true"></i>    </p>
                        <p class="text-center">Users</p>
                        <div class="contents d-flex flex-column justify-content-center ms-1 ">
                            <p class="text-center"><a href="users.php" class="text-decoration-none">Active users</a></p>
                            <button class="btn btn-primary my-3">Generate Report</button>
                        </div>
                    </div>

                </div>
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

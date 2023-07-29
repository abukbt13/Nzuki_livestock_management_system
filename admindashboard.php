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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</head>
<body>
<style>
    .main{
        width: 100vw;
        height: 100vh;
    }
    .sidebar{
        min-height: 100vh;
        max-height: 110vh;
        overflow: scroll;
        background: #ddd;
    }
    .sidebar li {
        margin-top: 1rem;
    }
    li{
        padding: 1rem;
    }
   li a{
       text-decoration: none;
   }
   li:hover{
       background: white;
       padding: 0.5rem;
       color: white;
   }
</style>
<?php include'header.php'; ?>
<div class="container-main">
    <div class="main d-flex">

        <i style="font-size: 30px;" class="fa d-block d-md-none d-lg-none fa-arrow-circle-left"  onclick="showSidebar()" ></i>

        <div id="sidebar" class="sidebar  d-none  d-md-block d-lg-block  w-25">

           <div class="d-flex pt-5 flex-column align-items-center">
               <ul style="list-style: none;" class="">
                   <li> <i class="fa  fa-home" aria-hidden="true"></i> <a href="admindashboard.php"> Home</a></li>
                   <li> <i class="fa fa-th-list" aria-hidden="true"></i><a href="uploadproduct.php"> Products</a></li>
                   <li> <i class="fa fa-btc" aria-hidden="true"></i><a href="activebids.php"> Active bids</a></li>
                   <li> <i class="fa fa-btc" aria-hidden="true"></i><a href="processedbids.php"> Processed bids</a></li>
                   <li> <i class="fa fa-user" aria-hidden="true"></i><a href="users.php"> Users</a></li>

               </ul>
           </div>
        </div>
        <div class="w-75">
            <div id="side" class="sidebar-content" id="sidebar_content">
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
                <div class="">
                    <div class="row">
                        <div class="col col-md-5 col-lg-5 m-3 ">
                            <div class="products m-3 bg-info w-100">
                                    <p class="text-center"><i style="font-size: 30px;padding-top: 2rem;" class="fa fa-product-hunt" aria-hidden="true"></i>    </p>
                                    <p class="text-center">PRODUCTS</p>
                                    <div class="contents d-flex flex-column justify-content-center ms-1 ">
                                        <p class="text-center">
                                            <a href="uploadproduct.php" class="text-decoration-none">view products</a>
                                        </p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#product">
                                            Generate Now
                                        </button>
                                </div>

                            </div>

                        </div>
                        <div class="col col-md-5 col-lg-5 m-3 ">
                            <div class="products m-3 bg-info w-100">
                                <p class="text-center"><i style="font-size: 30px;padding-top: 2rem;" class="fa fa-btc" aria-hidden="true"></i>    </p>
                                <p class="text-center">Bids</p>
                                <div class="contents d-flex flex-column justify-content-center ms-1 ">
                                    <p class="text-center"><a href="activebids.php" class="text-decoration-none">view active bids</a></p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bids">
                                        Generate Now
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="products bg-info m-3 w-50">
                    <p class="text-center"><i style="font-size: 30px;padding-top: 2rem;" class="fa fa-users" aria-hidden="true"></i>    </p>
                    <p class="text-center">Users</p>
                    <div class="contents d-flex flex-column justify-content-center ms-1 ">
                        <p class="text-center"><a href="users.php" class="text-decoration-none">Active users</a></p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#users">
                            Generate Now
                        </button>
                    </div>
                </div>
            </div>


                <div class="modal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="product">Generate report on products</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">
                                    <form action="reports/activeproducts.php">
                                        <button type="submit" class="btn  my-1 btn-primary">Active products</button>
                                    </form>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <form action="reports/productsonbid.php">
                                        <button type="submit" class="btn  my-1   btn-primary">Products on bids</button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="bids" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="product">Generate report on Bids</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center mt-2">Generate report on</p>
                                <form action="reports/activebids.php">
                                    <button type="submit" class="btn w-100 my-1 btn-primary">Generate report on active bids</button>
                                </form>
                                <form action="reports/successbids.php">
                                    <button type="submit" class="btn w-100  my-1  btn-primary">Generate report on success bids</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="product">Generate report on Users</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center mt-2">Generate report on</p>
                                <form action="reports/allusers.php">
                                    <button type="submit" class="btn w-100 my-1 btn-primary">Generate report on all users</button>
                                </form>
                                <form action="reports/activeusers.php">
                                    <button type="submit" class="btn w-100  my-1  btn-primary">report on active users</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
<script>
    const side = document.getElementById('side')
    const sidebar = document.getElementById('sidebar')
    function showSidebar () {
        side.classList.toggle('d-none')
        sidebar.classList.toggle('d-none')
        sidebar.classList.toggle('w-100')
    }
</script>

</body>
</html>

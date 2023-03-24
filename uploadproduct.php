<?php
session_start();
include 'connection.php';
$user_id=$_SESSION['user_id'];
$role= $_SESSION['role'];
if($role!=1){
    header('Location:dashboard.php?');
}
if(isset($_POST['upload_item'])){
    session_start();
    $item_name=$_POST['item_name'];
    $min_price=$_POST['min_price'];
    $max_price=$_POST['max_price'];
    $livestock_name=$_POST['livestock_name'];

    $filename=$_FILES['picture']['name'];
    $filetmp=$_FILES['picture']['tmp_name'];

    $photo_new_name= uniqid(10,11111).$filename;


    $sql = "INSERT INTO items (item_name,min_price,max_price,livestock_name,photo,user_id) values('$item_name','$min_price','$max_price','$livestock_name','$photo_new_name',1)";
    $sql_run = mysqli_query($conn,$sql);
    if ($sql_run){
        move_uploaded_file($filetmp,"items/".  $photo_new_name);
        $_SESSION['status']="You have successfully added an item";
        header("location:uploadproduct.php");
    }
    else {
        $_SESSION['status']="An error occurred. Please try again with correct details";
        header("location:uploadproduct.php");
    }
}
if(isset($_POST['delete'])){
   $id=$_POST['idno'];
   $delete="delete from items where id='$id'";
   $delete_run=mysqli_query($conn,$delete);
   if($delete_run){
       echo "<script>alert('deleted successfully')</script>";
       $_SESSION['status']="Item Deleted successfully";
       header("location:uploadproduct.php");

   }
}
?>
<style>
    .content11{
        position: relative;


    }
    .topnav{
        position: sticky;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        background: #59535F;
        align-items: center;
    }
    table{
        margin-left: 0.4rem;
        width: 100%;
    }
    td{
        margin: 0px 8px 0px 8px;
        text-align: center;
        align-content: center;
    }
    table ,tr,td,th{
        border: 1px solid white;
        /*background: yellow;*/
        border-collapse: collapse;
    }
    .showitems{
        display: block;
    }
.form{
    position: absolute;top: 5rem;left:19rem;
    z-index: 1;
    background: cadetblue;
    padding-left: 2rem;
    border: 2px solid green;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-bottom: 2rem;
    padding-top: 1rem;
    width:25rem;
    display: none;index
}
</style>
<?php include 'header.php'; ?>
<div class="content11">
    <?php
    if(isset($_SESSION['status'])){
        ?>

                <div class="msg">
                    <p><?php echo $_SESSION['status'] ?></p>
                </div>

        <?php
        unset($_SESSION['status']);
    }
    ?>
   <div class="topnav" style="padding-left: 1.5rem;">
       <h2>Items on bid</h2>

       <button id="add" style="margin-right:2rem;text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-plus" aria-hidden="true"></i>Add more</button>
       <button id="close" style="display:none; margin-right:2rem;text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-close" aria-hidden="true"></i>Close</button>
   </div>
    <table class="table table-hover table-bordered text-center">
        <tr class="text-center">
            <th>id</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product price</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php
        include 'connection.php';
        $items="select * from items where status = '0'";

        $items_run=mysqli_query($conn,$items);
           while($posts=mysqli_fetch_assoc($items_run)) {
                ?>

        <tr>
            <td><?php echo $posts['id']?></td>
            <td id="post_name"><?php echo $posts['item_name']?></td>
            <td>
                <img src="items/<?php echo $posts['photo']?>" alt="Image not found" height="100" width="100">
            </td>
            <td><?php echo $posts['min_price']?></td>
            <td>
            <form action="editproduct.php"  method="post">
                <input type="text" name="idno" hidden="" value="<?php echo $posts['id']?>">
                <button type="submit" class="btn btn-secondary" name="edit">Edit Item</button>
            </form>
            </td>
            <td>
                <form action="uploadproduct.php"  method="post">
                    <input type="text" name="idno" hidden="" value="<?php echo $posts['id']?>">
                    <button type="submit" class="btn btn-danger" name="delete">Delete Item</button>
                </form>
            </td>
        </tr>
        <?php
           }
        ?>


    </table>


</div>

<form class="form border-2-primary" id="form" action="uploadproduct.php" method="post" enctype="multipart/form-data">
    <h5 id="head">Upload Items For Bidding</h5>
    <div class="upload-items">
        <div class="form-group">
            <label for="">Description</label><br>
            <input type="text" id="item_name" name="item_name" id="" placeholder="Description of the livestock">
        </div>
        <br>
        <div class="form-group>
            <label for="">Minimum price</label><br>
            <input type="number" id="min_price" name="min_price" id="" placeholder="Enter manimum price"><br>
        </div><br>
        <div class="form-group">
            <label for="">Maximum price</label><br>
            <input type="number" id="max_price" name="max_price" id="" placeholder="Enter maximum price">
        </div><br>
        <div class="form-group">
            <label for="">Livestock Name</label><br>
            <select  class="form-control" id="livestock_name" name="livestock_name" id="">
                <option>--Select livestock--</option>
                <option value="sheep">Sheep</option>
                <option value="goat">Goat</option>
                <option value="cow">Cow</option>
                <option value="donkey">Donkey</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Picture</label><br>
            <input id="picture" type="file" name="picture" id="">
        </div>
    <div class="form-group mt-2">
        <input type="submit" id="submit" class="btn btn-primary form-control" name="upload_item" value="Uploadproduct">
    </div>
    </div>
</form>

<script>

    const add=document.getElementById('add');
    const close=document.getElementById('close');
    const form=document.getElementById('form');
    add.addEventListener('click', function(e) {
        form.style.display="block";
        add.style.display="none";
        close.style.display="block";
    })
    close.addEventListener('click', function(e) {
        form.style.display="none";
        add.style.display="block";
        close.style.display="none";
    })

    // const edit_item=document.getElementById('edit_item');
    // edit_item.addEventListener('click',()=>{
    //     form.style.display="block";
    //     add.style.display="none";
    //     close.style.display="block";
    //     const submit=document.getElementById('submit');
    //     const item_name=document.getElementById('item_name');
    //     const min_price=document.getElementById('min_price');
    //     const max_price=document.getElementById('max_price');
    //     const post_name=document.getElementById('post_name').value;
    //     submit.value="Edit Item";
    //     item_name.value='+post_name+';
    //     submit.name="edit_item";
    //
    // })
</script>
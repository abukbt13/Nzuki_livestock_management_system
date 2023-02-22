<?php
include './connection.php';
if(isset($_POST['upload_item'])){
    session_start();
    $item_name=$_POST['item_name'];
    $min_price=$_POST['min_price'];
    $max_price=$_POST['max_price'];
    $livestock_name=$_POST['livestock_name'];

    $filename=$_FILES['picture']['name'];
    $filetmp=$_FILES['picture']['tmp_name'];

    $photo_new_name=rand() . $filename;
    echo $photo_new_name;
    echo $item_name;
    echo $price;
    echo $category;
    $user_id=7;
//    die();

    $sql = "INSERT INTO items (item_name,min_price,max_price,livestock_name,photo,user_id) values('$item_name','$min_price','$max_price','$livestock_name','$photo_new_name',1)";
    $sql_run = mysqli_query($conn,$sql);
    if ($sql_run){
        move_uploaded_file($filetmp,"items/".  $photo_new_name);
        $_SESSION['status']="You have successfully added an item";
        header("location:admindashboard.php");
    }
    else {
        $_SESSION['status']="An error occurred. Please try again with correct details";
        header("location:admindashboard.php");
    }
}
?>
<style>
    .content11{
        /*background: #DBC0F9;*/
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
<div class="content11">
   <div class="topnav" style="padding-left: 1.5rem;">
       <p>Products</p>
       <button id="add" style="margin-right:2rem;text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-plus" aria-hidden="true"></i>Add more</button>
       <button id="close" style="display:none; margin-right:2rem;text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-close" aria-hidden="true"></i>Close</button>
   </div>
    <table>
        <tr>
            <th>id</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product price</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php
        include './connection.php';
        $items="select * from items where status = '0'";

        $items_run=mysqli_query($conn,$items);
           while($posts=mysqli_fetch_assoc($items_run)) {
                ?>

        <tr>
            <td><?php echo $posts['id']?></td>
            <td><?php echo $posts['item_name']?></td>
            <td>
                <img src="items/<?php echo $posts['photo']?>" alt="Image not found" height="100" width="100">
            </td>
            <td><?php echo $posts['min_price']?></td>
            <td>
                <button id="edit" style="text-align:center; text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-plus" aria-hidden="true"></i>Edit Item</button>
            </td>
            <td>
                <button id="edit" style="text-align:center;text-transform:uppercase;background: blue;color: white; padding: 0.2rem; border:none;height: 2rem; padding-right: 1rem;"> <i class="fa fa-plus" aria-hidden="true"></i>Delete Item</button>
            </td>
        </tr>
        <?php
           }
        ?>


    </table>


</div>

<form class="form" id="form" onsubmit="preventdefault(e)" action="admindashboard.php" method="post" enctype="multipart/form-data">
    <h2>Upload Items here for sale</h2>
    <div class="upload-items">
        <div class="input-group">
            <label for="">Item name</label><br>
            <input type="text" name="item_name" id=""><br>
        </div>
        <br>
        <div class="input-group">
            <label for="">Minimum price</label><br>
            <input type="number" name="min_price" id="" placeholder="Enter manimum price"><br>
        </div><br>
        <div class="input-group">
            <label for="">Maximum price</label><br>
            <input type="number" name="max_price" id="" placeholder="Enter maximum price"><br>
        </div><br>
        <div class="input-group">
            <label for="">Livestock Name</label><br>
            <select name="livestock_name" id="">
                <option value="cattle">Cattle</option>
                <option value="sheep">Sheep</option>
                <option value="goat">Goat</option>
                <option value="donkey">Donkey</option>
            </select><br>
        </div><br>
        <div class="input-group">
            <label for="">Picture</label><br>
            <input type="file" name="picture" id=""><br>
        </div>
        <br>
        <input type="submit" name="upload_item" value="Uploadproduct">
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
</script>
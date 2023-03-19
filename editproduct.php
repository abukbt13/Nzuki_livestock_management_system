<?php
include 'connection.php';
if(isset($_POST['edit'])){
    $id=$_POST['idno'];
    }
include 'connection.php';
$items="select * from items where id = '$id'";
$itemsrun=mysqli_query($conn,$items);

$eachitem=mysqli_fetch_all($itemsrun,MYSQLI_ASSOC);
foreach ($eachitem as $item){
    $item_name=$user["item_name"];
    $min_price=$user["min_price"];
    $max_price=$user["max_price"];
    $description=$user["profile_image"];
}

?>
<div class="item">
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

</div>

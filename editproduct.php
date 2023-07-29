<?php
include 'connection.php';
if(isset($_POST['edit'])){
    $id=$_POST['idno'];
    }
$items="select * from items where id = '$id'";
$itemsrun=mysqli_query($conn,$items);

$eachitem=mysqli_fetch_all($itemsrun,MYSQLI_ASSOC);
foreach ($eachitem as $item){
    $item_name=$item["item_name"];
    $min_price=$item["min_price"];
    $max_price=$item["max_price"];
    $photo=$item["photo"];
}
?>
<div class="item">
    <button onclick="alert('fghjk')" class="btn btn-primary">javascript</button>
    <form class="form border-2-primary" id="form" action="uploadproduct.php" method="post" enctype="multipart/form-data">
        <h5 id="head">Upload Items For Bidding</h5>
        <div class="upload-items">

            <div class="form-group>
            <label for="">Minimum price</label><br>
            <input type="number" id="min_price" name="min_price" value="<?php echo $min_price?>" placeholder="Enter manimum price"><br>
        </div><br>
        <div class="form-group">
            <label for="">Maximum price</label><br>
            <input type="number" id="max_price" name="max_price"  value="<?php echo $max_price?>" placeholder="Enter maximum price">
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

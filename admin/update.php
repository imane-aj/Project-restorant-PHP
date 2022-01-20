<?php require 'db.php' ?>
<?php require 'head.php' ?>
<?php
$name = $desc = $price = $img = $catg = $nameError = $descError = $priceError = $imgError = $catgError = '';
if(!empty($_GET['id'])){
$id = checkInput($_GET['id']);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
$id = checkInput($_POST['id']);
$name = checkInput($_POST['name']);
$desc = checkInput($_POST['description']);
$price = checkInput($_POST['price']);
$catg = checkInput($_POST['category']);
$img = checkInput($_FILES['img']['name']);
$imgPath = '../img/' . basename($img);
$imgExtesion = pathinfo($imgPath, PATHINFO_EXTENSION);
$isSuccess = true;
$isUpload = '';

if(empty($name)){
$nameError = 'This field can not be empty';
$isSuccess = false;
}if(empty($desc)){
$descError = 'This field can not be empty';
$isSuccess = false;
}if(empty($price)){
$priceError = 'This field can not be empty';
$isSuccess = false;
}if(empty($catg)){
$catgError = 'This field can not be empty';
$isSuccess = false;
}if(empty($img)){
$isUploaded = false;
}else{
$isUploaded= true;
$isUpload = true;
if($imgExtesion != 'jpg' && $imgExtesion != 'png' && $imgExtesion != 'jpeg' && $imgExtesion != 'gif'){
$imgError = 'The authorized files are : jpg - png - jpeg - gif';
$isUpload = false;
}if($_FILES['img']['size']>500000){
$imgError = 'The file must not exceed 500KB';
$isUpload = false;
}if(file_exists($imgPath)){
$imgError = 'This file already exists';
$isUpload = false;
}if($isUpload){
if(!move_uploaded_file($_FILES['img']['tmp_name'],$imgPath)){
$imgError = 'There was an error while uploading';
$isUpload = false;
}
}
}
if(($isUpload && $isUploaded && $isSuccess) || (!$isUploaded && $isSuccess)){
$db = database::connect();
if($isUploaded){
$statement = $db->prepare('UPDATE products SET name=?, descreption=?, price=?, image=?, category=? WHERE id=?');
$statement->execute(array($name,$desc,$price,$img,$catg,$id));
}else{
$statement = $db->prepare('UPDATE products SET name=?, descreption=?, price=?, category=? WHERE id=?');
$statement->execute(array($name,$desc,$price,$catg,$id));
}
database::disconnect();
header('Location: index.php');

}else if($isUploaded && !$isUpload){
$db = database::connect();
$statement = $db->prepare('SELECT image FROM products WHERE id=?');
$statement->execute(array($id));
$row = $statement->fetch();
$img = $row['image'];
header('Location: index.php');
}

}
else{
$db = database::connect();
$statement = $db->prepare('SELECT * FROM products WHERE id=?');
$statement->execute(array($id));
$row = $statement->fetch();
$name=$row['name'];
$desc=$row['descreption'];
$price=$row['price'];
$catg=$row['category'];
$img=$row['image'];
database::disconnect();
}


function checkInput($data){
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}
?>


<h1 class='logo text-center'><i class="fas fa-utensils"></i> IM@N RESTO <i class="fas fa-utensils"></i></h1>
<div class='container admin view'>
<div class='row'>
<div class='col-sm-6'>
<h2><strong>Update Product</strong></h2>
<form method='post' enctype='multipart/form-data' action='update.php' role='form'>
<input type='hidden' name='id' value='<?php echo $id; ?>'>
<label for='name'>Name:</label>
<input type='text' id='name' name='name' class='form-control' placeholder='Name' value='<?php echo $name; ?>'>
<span class='error'><?php echo $nameError; ?></span>


<label for='description'>Description:</label>
<input type='text' id='description' name='description' class='form-control' placeholder='Description' value='<?php echo $desc; ?>'>
<span class='error'><?php echo $descError; ?></span>
<label for='price'>Price:</label>
<input type='number' id='price' step='0.01' name='price' class='form-control' placeholder='price' value='<?php echo $price; ?>'>
<span class='error'><?php echo $priceError; ?></span>
<label for='category'>Category:</label>
<select class='form-control' id='category' name='category' value='<?php echo $catg; ?>'>
<?php
$db = database::connect();
foreach($db->query('SELECT*FROM categories') as $row){
if($row['id'] == $catg)
echo '<option selected="selected" value="' . $row['id'] .'">' . $row['name'] . '</option>';
else
echo '<option value="' . $row['id'] .'">' . $row['name'] . '</option>';
} 
?>
</select>
<span class='error'><?php echo $catgError; ?></span>
<br>
<P><?php echo $img ?><p>
<input type='file' id='image' name='img'></br><br>
<span class='error'><?php echo $imgError; ?></span>
<button type='submit' name='add' class='btn btn-success'><i class="fas fa-pen"></i> Update</button>
<a class="btn btn-primary" href="index.php" role="button"><i class="fas fa-undo-alt"></i> return</a><br> <br>
</form>
</div>
<div class='col-sm-6'>
 <div class='img-thumbnail ctn site'>
                            <img src="<?php echo'../img/'.$img; ?>" class="img-thumbnail">
                            <div class='price'><?php echo number_format((float)$price,2,'.','') .' €'; ?> </div>
                            <div class='caption'>
                                <h4><?php echo ' '. $name; ?> </h4>
                                <p><?php echo ' '. $desc; ?></p>
                                <a htef='#' class='btn btn-order'><i class="fas fa-shopping-cart"></i> Order</a>
                            </div>
                        </div>
</div>
</div>
</div>
<?php require 'footer.php'?>
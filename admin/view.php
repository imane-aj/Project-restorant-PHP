<?php require 'head.php' ?>
<?php require 'db.php' ?>
<?php

if(!empty($_GET['id'])){
$id=checkInput($_GET['id']);

$db = database::connect();
$statement = $db->prepare('SELECT products.id,products.name,products.descreption,products.price,products.image, categories.name AS category FROM products INNER JOIN categories ON products.category=categories.id WHERE products.id=?');
$statement->execute(array($id));
$row = $statement->fetch();
}

function checkInput($data){
$data =trim($data);
$data =stripslashes($data);
$data =htmlspecialchars($data);
return $data;
}
?>

<h1 class='logo text-center'><i class="fas fa-utensils"></i> IM@N RESTO <i class="fas fa-utensils"></i></h1>
<div class='container admin view'>

<div class='row'>
<div class='col-sm-6'>
<h2>View Product</h2>
<form>
<div class='form-group'>
<label>name:</label><?php echo ' '. $row['name'] ?>
</div>
<div class='form-group'>
<label>description:</label><?php echo ' '. $row['descreption'] ?>
</div>
<div class='form-group'>
<label>price:</label><?php echo ' '. $row['price'] . ' €';?>
</div>
<div class='form-group'>
<label>category:</label><?php echo ' '. $row['category'] ?>
</div>
<div class='form-group'>
<label>image:</label><?php echo ' '. $row['image'] ?>
</div>
<div class='form-action'>
<a class="btn btn-primary" href="index.php" role="button"><i class="fas fa-undo-alt"></i> return</a>
</div>
</form>
</div>
<div class='col-sm-6'>
 <div class='img-thumbnail ctn site'>
                            <img src="<?php echo'../img/'.$row['image'] ?>" class="img-thumbnail">
                            <div class='price'><?php echo ' '. $row['price'] .' €'; ?> </div>
                            <div class='caption'>
                                <h4><?php echo ' '. $row['name'] ?> </h4>
                                <p><?php echo ' '. $row['descreption'] ?></p>
                                <a htef='#' class='btn btn-order'><i class="fas fa-shopping-cart"></i> Order</a>
                            </div>
                        </div>
</div>
</div>
</div>


<?php require 'footer.php' ?>
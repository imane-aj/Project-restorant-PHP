<?php require 'db.php' ?>
<?php require 'head.php' ?>
<?php
if(!empty($_GET['id'])){
$id = checkInput($_GET['id']);
}
if(!empty($_POST)){
$id = checkInput($_POST['id']);
$db = database::connect();
$statement = $db->prepare('DELETE FROM products WHERE id=?');
$statement->execute(array($id));
header('Location: index.php');
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
<h2><strong>Delete Product</strong></h2>
<form method='post' enctype='multipart/form-data' action='delet.php'>
<input type='hidden' name='id' value='<?php echo $id; ?>'>
<div class="alert alert-warning" role="alert">
 Do you realy want to Delet this product ?!
</div>
<button type='submit' name='delet' class='btn btn-warning'> Yes</button>
<a class="btn btn-light" href="index.php" role="button"> No</a><br> <br>
</form>
</div>

<?php require 'footer.php'?>
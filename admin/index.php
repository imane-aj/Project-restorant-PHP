


<?php require('head.php');?>

<?php 
session_start();
if(isset($_SESSION['admin'])){
if($_SESSION['admin']->Role==='Admin'){
echo '<h1 class="logo text-center"><i class="fas fa-utensils"></i> IM@N RESTO <i class="fas fa-utensils"></i></h1>
<div class="container admin">
<div class="row">

<table class="table table-striped table-bordered">
<h2><strong>Products List <a class="btn btn-success" href="add.php" role="button"><i class="fas fa-plus"></i> Add </a> <a class=\'btn logOut btn-warning\' href=\'../frontPages/frontPage.php\'>Log Out</a></strong></h2>

<thead>
<tr>
<th>name</th>
<th>description</th>
<th>price</th>
<th>category</th>
<th>Actions</th>
</tr>
</thead>
<tbody>'.
require 'db.php';
$dbd = database::connect();
$statement = $dbd -> query("SELECT products.id,products.name,products.descreption,products.price ,categories.name AS category FROM products LEFT JOIN categories ON products.category=categories.id ORDER BY products.id DESC");
while($row = $statement->fetch()){
echo '<tr>';
echo '<td>' .$row['name'] . '</td>';
echo '<td>' .$row['descreption'] . '</td>';
echo '<td>' .$row['price'] . '</td>';
echo '<td>' .$row['category'] . '</td>';
echo '<td width="300"><a class="btn btn-light" href="view.php?id='. $row['id']. 'role="button"><i class="far fa-eye"></i> View</a>';
echo ' ';
echo '<a class="btn btn-primary" href="update.php?id='. $row['id']. 'role="button"><i class="fas fa-pen"></i> Update</a>';
echo ' ';
echo '<a class="btn btn-danger" href="delet.php?id=' . $row['id']. 'role="button"><i class="far fa-trash-alt"></i> Delet</a>';
echo '</td>';
echo '</tr>';
}}else{
header('Location:/project-restaurant/frontPages/frontPage.php',true);
die('');
}}else{
header('Location:/project-restaurant/frontPages/frontPage.php',true);
die('');
}
?>
</tbody>

</table>
</div>
</div>


<?php require 'footer.php'?>

<?php 
//require 'validationForm.php'; 
require 'includes/head.php';
require 'includes/db.php';
?>
<style>
body{
background-image: url(includes/img.front/back.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    
}
</style>
<body>
<?php
if(isset($_GET['code'])){
$db = database::connect();
$checkCode = $db->prepare('SELECT SecurityCode FROM form WHERE SecurityCode = :SecurityCode');
$checkCode->bindParam('SecurityCode',$_GET['code']);
$checkCode->execute();
if($checkCode->rowCount()>0){
$Update = $db->prepare('UPDATE form SET SecurityCode = :newSecurityCode,VALIDATED=true WHERE SecurityCode=:SecurityCode');
$newSecurityCode = md5(date('h:i:s'));
$Update->bindParam('newSecurityCode',$newSecurityCode);
$Update->bindParam('SecurityCode',$_GET['code']);
if($Update->execute()){
echo "<div class='UserPge'>
        <div class='container'>
            <div class='row justify-content-end'>
<h4>Your account has been successfully verified</h4>
<h1>Congratulations !You Can Now<br>Order <span>Our Delicious</span> Meals</h1>
<a class='btn' id='log' href='loginPge.php'>Log in</a>
</div>
</div>
</div>";
}else{
echo "<div class='UserPge'>
        <div class='container'>
            <div class='row justify-content-end'>
<div class='alert alert-warning' role='alert'>
<h1>This Code is No Longer Usable</h1> </div></div></div></div>";
}
}
}
 require 'includes/footer.php';?>
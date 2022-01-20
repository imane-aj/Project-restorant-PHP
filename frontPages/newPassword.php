<?php
require 'includes/db.php'; 
require 'includes/head.php';
$succes='';

 if(isset($_POST['newPassword'])){
$db = database::connect();
$checkPassword = $db->prepare('SELECT*FROM form WHERE Email = :mail');
$Mail = checkInput($_POST['email']);
$checkPassword->bindParam('mail',$Mail);
$checkPassword->execute();
if($checkPassword->rowCount()>0){
require_once '../phpmailer/mailer.php';
$user = $checkPassword->fetchObject();
$security = $user->SecurityCode;
$mail->setFrom('imaneSD201820@gmail.com', 'IM@NE RESTO');
$mail->addAddress($Mail);
$mail->Subject = 'Password Reset Code';
$mail->Body ='<h1>IM@NE RESTO welcomes you Again</h1>'. '<div> Please click on the following link to reset your Password: </div><br>' . '<br><a href="/project-restaurant/frontPages/newPassword.php?email='.$Mail.'&code='.$security.'">'. 'href="/project-restaurant/frontPages/newPassword.php?email='.$Mail.'&code='.$security.'"</a>;<br>'.'<br><p>If you cannot activate your account with this link, please copy and paste it on a new browser tab.</p>'.'<p>If you have any questions, please send us an email at imaneSD201820@gmail.com Best regards Best regards</p>'.'<br><br><p>IM@NE RESTO Team</p>';
$mail->send();
}else{
$succes = '<p class="newPass">We could not find Your Email in Our system!</p>';
}
}

function checkInput($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<?php
$password = $PasswordError = '';
$isSuccess =false;
if(isset($_POST['newPass'])){
$password = checkPass($_POST['password']);
$isSuccess =true;
if(empty($password) || strlen($password)<6){
$PasswordError = 'The Password must contain 6 characters';
$isSuccess =false;
}
$db =database::connect();
$Update = $db->prepare('UPDATE form SET Password = :password WHERE Email = :mail');

$Update->bindParam('password',$password);
$Update->bindParam('mail',$_GET['email']);
$Update->execute();
}
function checkPass($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>

<style>
body{
background-image: url(includes/img.front/back.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    
}
</style>
<body>
        <div class='container'>
            <div class='row justify-content-end'>
<a class='btn a' href='frontPage.php'>Go Back To The Home Page !</a>
<?php
if(!isset($_GET['code'])){
echo '<div class="form login">
<form method="post">
<label class="form-label" for="email">Address Email:</label>
<div class="input-group">
<span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
<input type="email" name="email" id="email" placeholder="Write Your Email" class="form-control"  required>
</div>'.$succes.'<div class="d-grid gap-2">
<button type="submit" name="newPassword" class="btn btn-block log">New Password</button>
</div>
</form>';
}else if(isset($_GET['code']) && isset($_GET['email'])){
echo '<div class="form login">
<form  method="post">
<label class="form-label" for="password">New Password:</label>
<div class="input-group">
<span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
<input type="password" name="password" id="password" placeholder="Write New Password" class="form-control"  required>
</div> <span class="error">'.$PasswordError.'</span>
<div class="d-grid gap-2">
<button type="submit" name="newPass" class="btn btn-block log">New Password</button>
</div>
</form>';
}
?>

<?php require 'includes/footer.php';?>
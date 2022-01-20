<?php
require 'includes/db.php';
$Mail = $Password = $succes = $MailError='';
//$error = array('MailError'=>'','PasswordError'=>'');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$Mail = checkInput($_POST['email']);
$Password = checkInput($_POST['password']);
if(!isEmail($Mail)){
$MailError = 'enter the right syntaxe of email';
}
if(isset($_POST['twit'])){
$db = database::connect();
$checkUser = $db->prepare('SELECT*FROM form WHERE Email=:mail AND Password=:password');
$checkUser->bindParam('mail',$Mail);
$checkUser->bindParam('password',$Password);
$checkUser->execute();
if($checkUser->rowCount()===1){
$user=$checkUser->fetchObject();
if($user->VALIDATED === '1'){
session_start();
$_SESSION['user']=$user;

if($user->Role==='User'){
header('Location:/project-restaurant/foodPage/foodPge.php');
}}else{
$succes = 'activat your account';
}
}else{
$succes = 'password or email are not right';
}
}

}
function isEmail($var){
return filter_var($var,FILTER_VALIDATE_EMAIL);}
function checkInput($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<?php require 'includes/head.php';?>
<style>
body{
background-image: url(includes/img.front/healthy1.jpg);
        background-repeat: no-repeat;
        background-size: cover;
background-position:center;
    
}
</style>
<body>
        <div class='container'>
            <div class='row justify-content-center'>
<a class='btn a' href='frontPage.php'>Go Back To The Home Page !</a>
<div class="form login">

                              <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                <h1>LOGIN</h1>
                                <label class="form-label" for='email'>Email Address<span class="req">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                    <input class="form-control" id='email' name='email' type="email" required autocomplete="off" placeholder="Enter Your Gmail" />
                                </div>
<span class='error'> <?php echo $MailError ?></span>
                                <label class="form-label" for='password'> Password<span class="req">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                                    <input class="form-control" id='password' name='password' type="password" required autocomplete="off" placeholder="Enter Your Password" />
                                </div>

                                <p class="forgot"><a href="newPassword.php">Forgot Password?</a></p>
<div class='alert alert-warning' role='alert' style='display:<?php if($succes) echo "block";else echo "none;"?>'>
<?php echo $succes; ?>
</div>
                                <div class="d-grid gap-2">
                                    <button type='submit' name='twit' class="btn btn-block log">Twiiiiiiiiiiit !</button>
                                </div>

                            </form>
</div>
</div>
</div>


<?php require 'includes/footer.php';?>
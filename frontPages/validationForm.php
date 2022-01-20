<?php
require 'includes/db.php';
$Fname = $Lname = $City = $Adress  = $Phone = $Mail = $Password = $succes = '' ;
$isSuccess =false;
$error = array('FnameError'=>'' , 'LnameError'=>'' , 'CityError'=>'', 'AdressError'=>'' , 'MailError'=>'','PasswordError'=>'','PhoneError'=>'');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$Fname = checkInput($_POST['fname']);
$Lname = checkInput($_POST['lname']);
$City = checkInput($_POST['city']);
$Adress = checkInput($_POST['adress']);
$Mail = checkInput($_POST['email']);
$Password = checkInput($_POST['password']);
$isSuccess =true;



if(empty($Fname) || strlen($Fname)<3  || is_numeric($Fname)){
$error['FnameError'] = 'This field cannot be less than 3 characters or containes numbers';
$isSuccess =false;
}
if(empty($Lname) || strlen($Lname)<3 || is_numeric($Lname)){
$error['LnameError'] = 'This field cannot be less than 3 characters or containes numbers';
$isSuccess =false;
}
if(empty($City) || is_numeric($City) || strlen($City)<3){
$error['CityError'] = 'This field can not be empty or containes numbers!';
$isSuccess =false;
}
if(empty($Adress)){
$error['AdressError'] = 'This field can not be empty!';
$isSuccess =false;
}
if(!isEmail($Mail)){
$error['MailError'] = 'You must to write your real Email';
$isSuccess =false;
}
if(empty($Password) || strlen($Password)<6){
$error['PasswordError'] = 'The Password must contain 6 characters';
$isSuccess =false;

}
if(!isPhone($Phone)){
$error['PhoneError'] = 'Write your phone Number!';
$isSuccess =false;
}
if(isset($_POST['sub'])){
   
$isSuccess = true;

$db = database::connect();
$statement = $db->prepare('SELECT * FROM form WHERE Email = :Mail');
$statement->bindParam("Mail", $Mail);
$statement->execute();
if($statement->rowCount()>0){
$error['MailError'] = 'This account exist already';
}else{

$statement=$db->prepare('INSERT INTO form (Fname,Lname,City,Adress,Phone,Email,Password, SecurityCode, Role) VALUES (:name,:lname,:city,:adress,:phone,:mail,:password,:securityCode,"User")');

$statement->bindParam('name',$Fname);
$statement->bindParam('lname',$Lname);
$statement->bindParam('city',$City);
$statement->bindParam('adress',$Adress);
$statement->bindParam('phone',$Phone);
$statement->bindParam('mail',$Mail);
$statement->bindParam('password',$Password);
$securityCode = md5(date('h:i:s'));
$statement->bindParam('securityCode',$securityCode);
if($statement->execute()){

require '../phpmailer/mailer.php';
$mail->setFrom('imaneSD201820@gmail.com', 'IM@NE RESTO');
$mail->addAddress($Mail);
$mail->Subject = 'Email Verification Code';
$mail->Body = '<h1>IM@NE RESTO welcomes you</h1>'. '<div>Thank you for signing up for IM@NE RESTO. We"re happy you"re here'.$Fname.'! Please click on the following link to complete your registration: </div><br>' . '<br><a href="/project-restaurant/frontPages/acceptUser.php?code='.$securityCode.'">' . 'href="/project-restaurant/frontPages/acceptUser.php?code='.$securityCode.'"</a>;<br>'.'<br><p>If you cannot activate your account with this link, please copy and paste it on a new browser tab.</p>'.'<p>If you have any questions, please send us an email at imaneSD201820@gmail.com Best regards Best regards</p>'.'<br><br><p>IM@NE RESTO Team</p>';
$mail->send();
$Fname = $Lname = $City = $Adress  = $Phone = $Mail = $Password = '' ;
$succes = '<div class="alert alert-success">Check your email and validate your account </div>';
}
}
                       
}

}
 function checkInput($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
function isEmail($var){
return filter_var($var,FILTER_VALIDATE_EMAIL);}
function isPhone($var){
return preg_match('/^[0-9 ]*$/',$var);}

?>
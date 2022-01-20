<?php 
require 'validationForm.php'; 
require 'includes/head.php';
?>
<body>
  <?php require 'includes/navBar.php'?>
<div class='container'>
<div class='header'>
<div class='row'>
<div class='col-xs-12 col-md-6 '>
<div class='parag-partie' style='padding-top:8em;' data-aos="fade-right" >
<h1>Hungry?You're in the right place</h1>
<p>-20% * on your first order by subscribing to our application. Receive our best offers by email!</p>
<a class='btn' href='#sub'>Subscribe Now!</a>
</div>
</div>
<div class='col-xs-12 col-md-6'>
<div class='img-partie' data-aos="fade-left">
<img src='includes/img.front/hungry.jpg' class="img-fluid" alt='delivery-img'>
</div>
</div>
</div>
</div>
<div class='row g-2'>
<div class='img-container col-md-6'>
<div class='img-partie' data-aos="fade-right">
<img src='includes/img.front/loveFood.jpg' class='disp' alt='delivery-img' style='max-width: 70%;'>
</div>
</div>
<div class='col-md-6 order-first order-md-2' style='padding-top:6em;'>
<div style='margin-top:-4rem;' data-aos="fade-left">
<div class='parag-partie' >
<h1>Enjoy the delicious Food Experience</i></h1>
<p>Order from IM@N RESTO and get the most delicious dishes
 With all flavors and most importantly, you will get fast delivery</p>
<a class='btn' href='#sub' style='background-color: #f46d6a;
    color: #fff;'>How it work!</a>

</div>
</div>
</div>
</div>
  <div class='work'>
        
            <div class='row text-center'>
                <h2 >How it <span>works</span></h2>
                <div class='col-xs-12 col-md-3 parWork'>
                    <img src='includes/img.front/burg.png' alt='food-icon'>
                    <p>Choose Your Favorite Food</p>
                </div>
                <div class='col-xs-12 col-md-3  parWork'>
                    <img src='includes/img.front/deliv.png' alt='delivery-icon'>
                    <p>Free And Fast Delivery</p>
                </div>
                <div class='col-xs-12 col-md-3  parWork'>
                    <img src='includes/img.front/payment.png' alt='payment-icon'>
                    <p>Easy Payment Methods</p>
                </div>
                <div class='col-xs-12 col-md-3  parWork'>
                    <img src='includes/img.front/enjoy.jpg' alt='food-icon'>
                    <p>And Finally,Enjoy Your Food</p>
                </div>
            </div>
       
    </div>

    <div class='partie-sub'>
                <div class='row justify-content-center'>
                     <div class="form" id='sub'>
                          <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                     <h1>SubscribE</h1>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name='fname' placeholder="First Name" required autocomplete="off"value='<?php echo $Fname ?>'>
                                </div>
                                <span class='error'> <?php echo $error['FnameError'] ?></span>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" text='lname' name='lname' placeholder="Last Name" required autocomplete="off" value='<?php echo $Lname ?>' />
                                    
                                </div>
                                   <span class='error'> <?php echo $error['LnameError'] ?></span>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-city"></i></span>
                                    <input type="text" class="form-control" name='city' placeholder="City" required autocomplete="off" value='<?php echo $City ?>'/>
                                   
                                </div>
                                <span class='error'> <?php echo $error['CityError'] ?></span>

                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-home"></i></span>
                                    <input type="text" class="form-control" name='adress' placeholder="Home Adress" required autocomplete="off" value='<?php echo $Adress ?>'/>
                                </div>
                                <span class='error'> <?php echo $error['AdressError']; ?></span>
                               <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                                    <input type="text" class="form-control" name='phone' placeholder="Phone Number" required autocomplete="off" value='<?php echo $Phone ?>'/>
                                
                                </div>
                               <span class='error'> <?php echo $error['PhoneError'] ?></span>
                             <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                    <input type="text" class="form-control" name='email' placeholder="Email Adress" required autocomplete="off" aria-describedby="basic-addon1" value='<?php echo $Mail ?>'/>
                                  
                                </div>
                                  <span class='error'> <?php echo $error['MailError'] ?></span>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                                    <input type="password" class="form-control" name='password' placeholder="Set a Password" required autocomplete="off" value='<?php echo $Password ?>' />
                                 
                                </div>
                             <span> <?php echo $error['PasswordError'] ?></span>
                                <div class="d-grid gap-2">
                                    <button type='submit' class="btn btn-block log" name='sub' ><i class="fas fa-paper-plane"></i> Let's Get Started !</button>
                                </div>
                               <div><?php echo $succes ?></div>
                            </form>
                        </div>
                     </div>
                </div>

<footer>
<div class='row'>
<h4>This webSite was create by me 'Imane Ajroudi' only to practice my <br><br>Skills on HTML/CSS/BOOTSTRAP/PHP</h4>
</div>
</footer>


 <script>
         AOS.init();
    </script>
  



   <?php require 'includes/footer.php';?>
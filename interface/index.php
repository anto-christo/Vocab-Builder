<!doctype html>
<html lang="en" class="no-js">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
  <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
  <link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
  <script src="js/modernizr.js"></script> <!-- Modernizr -->
    
  <title>Log In &amp; Sign Up Form</title>

<!--
graph
-->
<style>
/* Load animation */

@-webkit-keyframes 
load { 0% {
stroke-dashoffset:0
}
}
@-moz-keyframes 
load { 0% {
stroke-dashoffset:0
}
}
@keyframes 
load { 0% {
stroke-dashoffset:0
}
}

/* Container */

.prog {
  position: relative;
  display: inline-block;
  padding: 0;
  text-align: center;
}

/* Item */

.prog>div {
  display: inline-block;
  position: relative;
  text-align: center;
  color: #93A2AC;
  font-family: Lato;
  font-weight: 100;
  margin: 2rem;
}

.prog>div:before {
  content: attr(data-name);
  position: absolute;
  width: 100%;
  bottom: -2rem;
  font-weight: 400;
}

.prog>div:after {
  content: attr(data-percent);
  position: absolute;
  width: 100%;
  top: 3.7rem;
  left: 0;
  font-size: 2rem;
  text-align: center;
}

.prog svg {
  width: 10rem;
  height: 10rem;
}

.prog svg:nth-child(2) {
  position: absolute;
  left: 0;
  top: 0;
  transform: rotate(-90deg);
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
}

.prog svg:nth-child(2) path {
  fill: none;
  stroke-width: 25;
  stroke-dasharray: 629;
  stroke: rgba(255, 255, 255, 0.9);
  -webkit-animation: load 10s;
  -moz-animation: load 10s;
  -o-animation: load 10s;
  animation: load 10s;
}
</style>



</head>


<body style="background-color:#DCD0D0">

<?php

  session_start();

  $_SESSION["username"];

    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['login'])) {
      
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['user_type'];

        $validate = "SELECT username,password FROM users WHERE username='$username' AND password='$password'";

        $result = $conn->query($validate);

        if($result->num_rows == 0){
            echo '<script>alert("Incorrect username or password")</script>';
        }

        else{
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['type'] = $type;

            if($_POST['user_type'] == "editor"){
              header("location: ../view/editor.html");
            }

            else if($_POST['user_type'] == "lit_pro"){
              header("location: ../view/lit_expert.html");
            }

            else if($_POST['user_type'] == "admin"){
              header("location: ../view/view_test.php");
            }

            else if($_POST['user_type'] == "user"){
              header("location: index.php");
            }
        }
    }


  if(isset($_POST['logout'])){
    
    $_SESSION['loggedin'] = FALSE;
    header("location: index.php");
  } 


    if (isset($_POST['register'])) {
 
    if ($_POST['password'] == $_POST['confirmpassword']) 
    {
      $name = $_POST['name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $check_user = "SELECT username FROM users WHERE username = '$username'";
      $check_email = "SELECT email FROM users WHERE email = '$email'";

      $result_user = $conn->query($check_user);
      $result_email = $conn->query($check_email);

      if($result_user->num_rows == 1){
        echo '
        <script>alert("Username already exists")</script>     
      ';
      }

      else if($result_email->num_rows == 1){
        echo '
        <script>alert("Email already registered")</script>      
      ';
      }

      else{
      $store_data = "INSERT INTO users (name,username,email,password) VALUES ('$name','$username','$email','$password')";

      if($conn->query($store_data) === TRUE){
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['loggedin'] = TRUE;

        header("location: index.php");
      }

     }
    }

    else{
      echo '
        <script>alert("Both the password dont match")</script>      
      ';
    }
}

?>


  <header role="banner">
    
    <nav class="main-nav">
      <ul>
        <!-- inser more links here -->
        <?php
          if(!$_SESSION["loggedin"]){
            echo '
              <li><a class="cd-signin" href="#0">Sign in</a></li>
              <li><a class="cd-signup" href="#0">Sign up</a></li>
            ';
          }

          if($_SESSION["loggedin"]){
            echo '<li style="color:white"> Welcome, '.$_SESSION["username"].'</li>
            <li><form method="POST" action="index.php"><button type="submit" name="logout" class="btn btn-danger">Logout</button></form></li>
            ';

            if($_SESSION["type"] == "editor"){
              echo '
                <li><a href="../view/editor.html"><button name="dashboard" class="btn btn-success">Dashboard</button></a></li>
              ';
            }
          }
        ?>
      </ul>
    </nav>
  </header>

  <div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
      <ul class="cd-switcher">
        <li><a href="#0">Sign in</a></li>
        <li><a href="#0">New account</a></li>
      </ul>

      <?php

        echo '

          <div id="cd-login"> <!-- log in form -->
        <form id="form_login" method="POST" action="index.php" class="cd-form">
          <p class="fieldset">
            <label class="image-replace cd-username" for="signin-username">Username</label>
            <input class="full-width has-padding has-border" id="signin-username" type="text" placeholder="Username" name="username">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <label class="image-replace cd-password" for="signin-password">Password</label>
            <input class="full-width has-padding has-border" id="signin-password" type="password"  placeholder="Password" name="password">
            
            <span class="cd-error-message">Error message here!</span>
          </p>
          <br>
          

          <input name="user_type" value="user" type="radio" id="user" checked>
            <label for="editor">User</label>
          <br>
          <input name="user_type" value="editor" type="radio" id="editor" unchecked>
            <label for="editor">Editor</label>
          <br>
          <input type="radio" name="user_type" value="lit_pro" id="literature_professional" unchecked>
            <label for="literature_professional">Literature Professional</label>  
          <br>
          <input type="radio" id="admin" name="user_type" value="admin" unchecked>
            <label for="admin">Admin</label>


          </p>

          <p class="fieldset">
            <button onclick="login_func()" class="btn btn-info" type="submit" name="login" value="Login">Login</button>
          </p>
        </form>
        
        <!-- <a href="#0" class="cd-close-form">Close</a> -->
      </div> <!-- cd-login -->

        ';

      ?>

      <?php

        echo '

          <div id="cd-signup"> <!-- sign up form -->
        <form id="form_register" class="cd-form" method="POST" action="index.php">

          <p class="fieldset">
            <label class="image-replace cd-username" for="signup-name">Name</label>
            <input class="full-width has-padding has-border" id="signup-name" type="text" placeholder="Name" name="name">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <label class="image-replace cd-username" for="signup-username">Username</label>
            <input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Username" name="username">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <label class="image-replace cd-email" for="signup-email">E-mail</label>
            <input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail" name="email">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <label class="image-replace cd-password" for="signup-password">Password</label>
            <input class="full-width has-padding has-border" id="signup-password" type="password"  placeholder="Password" name="password">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <label class="image-replace cd-password" for="signup-conpassword">Password</label>
            <input class="full-width has-padding has-border" id="signup-conpassword" type="password"  placeholder="Confirm Password" name="confirmpassword">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <button class="btn btn-info" type="submit" name="register" value="Create account">Create Account</button>
          </p>
        </form>

        <!-- <a href="#0" class="cd-close-form">Close</a> -->
      </div> <!-- cd-signup -->

        ';          

      ?>

      <div id="cd-reset-password"> <!-- reset password form -->
        <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

        <form class="cd-form">
          <p class="fieldset">
            <label class="image-replace cd-email" for="reset-email">E-mail</label>
            <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
            <span class="cd-error-message">Error message here!</span>
          </p>

          <p class="fieldset">
            <input class="full-width has-padding" type="submit" value="Reset password">
          </p>
        </form>

        <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
      </div> <!-- cd-reset-password -->
      <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
  </div> <!-- cd-user-modal -->

   <script type="text/javascript">
  function login_func() {
    document.getElementById("form_login").submit();
   }  

   function register_func() {
    document.getElementById("form_register").submit();
   }   
  </script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main.js"></script> <!-- Gem jQuery -->



<div class="container" style="padding-top: 40px">
<div class="col-md-8" >
<div class="well well-lg" style="background-color: rgb(255,255,255)">

<div class="row text-center">
  <div class="col-sm-4"  align="center">
    <div class="thumbnail">
      <div class="circle1" >
      <img src="img/science.png">
    
      </div>
      <p><strong class="deckdecor">Science</strong></p>
      <a href="deck1.html" style="text-decoration:none">
      <button class="button button1">Learn</button>
      </a>
    </div>
  </div>
  <div class="col-sm-4" align="center">
    <div class="thumbnail">
      <div class="circle1" >
      <img src="img/Medicine.png">
    
      </div>
      <p><strong>Medicine</strong></p>

      <button class="btn">Learn</button>
    </div>
  </div>
  <div class="col-sm-4" align="center">
    <div class="thumbnail">
      <div class="circle1" >
      <img src="img/Nature.png">
    
      </div>
      <p><strong class="deckdecor">Nature</strong></p>
            <button class="btn">Learn</button>

      
    </div>
  </div>
</div>
</div>






<!--

<div class="well well-lg">
   

  <div class="col-md-6">
    <div class="deckalign">
    <a href="deck1.html" style="text-decoration:none">
      <div class="circle1" >
      <img src="img/science.png">
    
      </div>
      <div align="left" style="padding:25px">
      <h2>Science</h2>
      </div>
    </a>
    </div>
  </div>
  <div class="col-md-6">
    <div class="deckalign">
    <a href="deck1.html" style="text-decoration:none">
      <div class="circle1" >
      <img src="img/science.png">
    
      </div>
      <div align="left" style="padding:25px">
      <h2>Science</h2>
      </div>
    </a>
    </div>


  </div>
</div>
-->

</div>


 <div class="col-md-4">
 <div class="well well-lg" style="background-color: rgb(255,255,255)">


  <div class="prog">
  <!--  Item  -->
  <!--  Item  -->
  <!--  Item  -->
  <div data-name="Daily Goal" data-percent="13%" align="center"> <svg viewBox="-10 -10 220 220">
    <g fill="none" stroke-width="12" transform="translate(100,100)">
      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="url(#cl1)"/>
      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="url(#cl2)"/>
      <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="url(#cl3)"/>
      <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="url(#cl4)"/>
      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="url(#cl5)"/>
      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="url(#cl6)"/>
    </g>
    </svg> <svg viewBox="-10 -10 220 220">
    <path d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="81"></path>
    </svg> </div>
  <!--  Item  -->
 
</div>


  </div>

<div class="well well-lg" style="background-color: rgb(255,255,255)">
<div >
<div>
  <h2 align="center" style="margin-bottom:20px">Total Progress</h2>
      <div class="w3-container w3-blue w3-round-large" style="width:25%">25%</div>
      </div>
</div>
</div>

  </div>
  
</div>


<!--
daily goal graph working
-->
<svg width="0" height="0">
<defs>
  <linearGradient id="cl1" gradientUnits="objectBoundingBox" x1="0" y1="0" x2="1" y2="1">
    <stop stop-color="#618099"/>
    <stop offset="100%" stop-color="#8e6677"/>
  </linearGradient>
  <linearGradient id="cl2" gradientUnits="objectBoundingBox" x1="0" y1="0" x2="0" y2="1">
    <stop stop-color="#8e6677"/>
    <stop offset="100%" stop-color="#9b5e67"/>
  </linearGradient>
  <linearGradient id="cl3" gradientUnits="objectBoundingBox" x1="1" y1="0" x2="0" y2="1">
    <stop stop-color="#9b5e67"/>
    <stop offset="100%" stop-color="#9c787a"/>
  </linearGradient>
  <linearGradient id="cl4" gradientUnits="objectBoundingBox" x1="1" y1="1" x2="0" y2="0">
    <stop stop-color="#9c787a"/>
    <stop offset="100%" stop-color="#817a94"/>
  </linearGradient>
  <linearGradient id="cl5" gradientUnits="objectBoundingBox" x1="0" y1="1" x2="0" y2="0">
    <stop stop-color="#817a94"/>
    <stop offset="100%" stop-color="#498a98"/>
  </linearGradient>
  <linearGradient id="cl6" gradientUnits="objectBoundingBox" x1="0" y1="1" x2="1" y2="0">
    <stop stop-color="#498a98"/>
    <stop offset="100%" stop-color="#618099"/>
  </linearGradient>
</defs>
</svg>






<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>


</body>
</html>
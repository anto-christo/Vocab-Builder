<?php
	
	session_start();

	$deck_name = $_SESSION['deck_name'];

	$conn = new mysqli("localhost","root","","vocab_test");

	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	$sql = "SELECT id,word,type,meaning,example FROM words WHERE deck='$deck_name'";

	$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>



<link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    
     <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,200,300,400,500,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    

    <link rel="stylesheet" media="screen" href="https://d296n67kxwq0ge.cloudfront.net/assets/flashcard_application-67189445fe9d375cfb49bd6d7f89fbd8.css" debug="false" />
<script src="https://d296n67kxwq0ge.cloudfront.net/assets/flashcard_application-317d62aa082a80d5311cf3542feea1e5.js" debug="false"></script>






	<link rel="stylesheet" href="css/test.css"> <!-- CSS reset -->


    <script src="js/one.js"></script> <!-- Modernizr -->



	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="js/bootstrap.js"></script>  	
    <script src="jquery-3.1.0.js"></script>


	<meta property="og:url" content="https://gre.magoosh.com/flashcards/vocabulary/high-frequency-words/veracious" />
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<link rel="stylesheet" media="screen" href="https://d296n67kxwq0ge.cloudfront.net/assets/flashcard_application-67189445fe9d375cfb49bd6d7f89fbd8.css" debug="false" />
<script src="https://d296n67kxwq0ge.cloudfront.net/assets/flashcard_application-317d62aa082a80d5311cf3542feea1e5.js" debug="false"></script>



	<title>Log In &amp; Sign Up Form</title>
</head>
<body style="background-color:#DCD0D0">
	<header role="banner">
    
    <nav class="main-nav">
      <ul>
      <li class="navbar-header nav_head">INEPTER </li>
        <li><a class="nav_designhome " href="../interface/index.php">Home</a></li>
              <li><a class="nav_designtest" href="../interface/view_test.php">Test</a></li>



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

            if($_SESSION["type"] == "lit_pro"){
              echo '
                <li><a href="../view/lit_expert.html"><button name="dashboard" class="btn btn-success">Dashboard</button></a></li>
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
          </p><br>

          <input name="user_type" value="user" type="radio" id="user" checked>
            <label for="editor">User</label>
          <br>
          <input name="user_type" value="editor" type="radio" id="editor" unchecked>
            <label for="editor">Editor</label>
          <br>
          <input type="radio" name="user_type" value="lit_pro" id="literature_professional" unchecked>
            <label for="literature_professional">Literature Professional</label>  
          <br>

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





<div style="padding-top: 40px">



<?php

	if($result->num_rows > 0){

		while($row = $result->fetch_assoc()){
			echo '
		<div class="container">
    <div class="row">
     <div class="col-sm-10 col-sm-offset-1">
         <div class="col-md-10 col-sm-6">
             
        </div> <!-- end col sm 3 -->
<!--         <div class="col-sm-1"></div> -->
        <div class="col-md-12 col-sm-6">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div style="margin-top: 30px; margin-left:30px">
                            <input type="image" width="30px" height="auto" src="img/sound.png">

                        </div>
                       
                        <div class="content">
                            <div class="main">
                                <h3 class="name">'.$row["word"].'</h3>
                                
                            </div>
                            <div class="footer" id="'.$row["id"].'">
                                <button class="btn btn-simple" onclick="rotateCard(this)">
                                    <i class="fa fa-mail-forward"></i> Tap to see meaning
                                </button>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-left">'.$row["meaning"].'</h4>
                                <p class="text-left">'.$row["example"].'</p>



            <div class="toppadding">
	<a href="#'.$row["id"].'"><button class="iknow" onclick="rotateCard(this)"  ">I know this word</button></a>
	</div>
	<div class="toppadding">
	<a href="#'.$row["id"].'"><button class="idont" onclick="rotateCard(this)" style="padding-top:20px">I do not know this word</button></a>
	</div>

<script>
 var inc=0;
 function myFunction() {
    inc=inc+1;
    alert(inc);    
 }

  </script>





                            </div>
                        </div>
                        
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
        </div> <!-- end col sm 3 -->
<!--         <div class="col-sm-1"></div> -->



</div>
	';
		}
	}

?>

<center><a href="index.php"><button type="button" class="btn btn-success">Completed</button></a></center>

</body>
</html>
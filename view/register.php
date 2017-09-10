<?php

	session_start();
    $_SESSION['message'] = '';

    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
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

    		header("location: view_test.php");
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

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

<form method="POST" action="register.php">
	<center>
		Full Name : <input type="text" name="name"><br>
		Username : <input type="text" name="username"><br>
		Email : <input type="text" name="email"><br>
		Password : <input type="text" name="password"><br>
		Confirm Password : <input type="password" name="confirmpassword"><br>
		<button type="submit" name="register" class="btn btn-info">Register</button>
	</center>
</form>

</body>
</html>
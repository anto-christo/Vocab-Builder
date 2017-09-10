<?php

	session_start();
    $_SESSION['message'] = '';

    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $validate = "SELECT username,password FROM users WHERE username='$username' AND password='$password'";

        $result = $conn->query($validate);

        if($result->num_rows == 0){
            echo '<script>alert("Incorrect username or password")</script>';
        }

        else{
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;

            header("location: view_test.php");
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

<form method="POST" action="login.php">
	<center>
		Username : <input type="text" name="username"><br>
		Password : <input type="text" name="password"><br>
		<button type="submit" name="register" class="btn btn-info">Login</button>
	</center>
</form>

</body>
</html>
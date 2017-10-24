<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Inepter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../interface/index.php">Home <span class="sr-only">(current)</span></a></li>
    </ul>
  </div>
</nav>

<form method="POST" action="admin.php">
<table class="table" border="1px">
  <tr>
    <th>Name</th>
    <th>Username</th>
    <th>Email</th>
  </tr>

  <?php

    session_start();

    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT name,username,email,request FROM users WHERE request=2 OR request=3";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        if($row["request"] == 2){
            echo '
              <tr>
              <td>'.$row["name"].'</td>
              <td>'.$row["username"].'</td>
              <td>'.$row["email"].'</td>
              <td><center><button type="submit" class="btn btn-success" name="grant_btn_lit" value="'.$row["username"].'">Grant Literature Pro Access</button></center>
</td>
              <td><center><button type="submit" class="btn btn-danger" name="delete_btn" value="'.$row["username"].'">Delete Request</button></center></td>             </tr>
            ';
        }

        else if($row["request"] == 3){
            echo '
              <tr>
              <td>'.$row["name"].'</td>
              <td>'.$row["username"].'</td>
              <td>'.$row["email"].'</td>
              <td><center><button type="submit" class="btn btn-success" name="grant_btn_edit" value="'.$row["username"].'">Grant Editor Access</button></center></td>
              <td><center><button type="submit" class="btn btn-danger" name="delete_btn" value="'.$row["username"].'">Delete Request</button></center></td>
              </tr>
            ';
        }

      }
    }

    if(isset($_POST['grant_btn_edit'])){
      $user = $_POST['grant_btn_edit'];

      $grant_edit = "UPDATE users SET type='3',request='1' WHERE username='$user'";

      if($conn->query($grant_edit)){
        echo '<script>alert("Permission granted")</script>';
      }

      else{
        echo '<script>alert("Permission not granted")</script>';
      }
    }

    if(isset($_POST['grant_btn_lit'])){
      $user = $_POST['grant_btn_lit'];

      $grant_lit = "UPDATE users SET type='2',request='1' WHERE username='$user'";

      if($conn->query($grant_lit)){
        echo '<script>alert("Permission granted")</script>';
      }

      else{
        echo '<script>alert("Permission not granted")</script>';
      }
    }

    if(isset($_POST['delete_btn'])){
      $user = $_POST['delete_btn'];

      $grant_lit = "UPDATE users SET request='1' WHERE username='$user'";

      if($conn->query($grant_lit)){
        echo '<script>alert("Permission declined")</script>';
      }

      else{
        echo '<script>alert("Permission not declined")</script>';
      }
    }
?>
</table>
</form>

</body>
</html>
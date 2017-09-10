<?php
    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, word, meaning FROM words WHERE deck=''";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Word Category</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<br>

<form method="POST" action="word_category.php">

<center>

<input type="text" name="deck_name" placeholder="Enter Deck Name" required><br><br>
<button type="submit" name="submit" value="Create Deck" class="btn btn-success">Create Deck</button><br><hr>

</center>
  <?php
if ($result->num_rows > 0) {

    // output data of each row
        while($row = $result->fetch_assoc()) {


            $func_name = 'a'.$row["id"];
            $btn_id = 'b'.$row["id"];

            echo '

            <div id="'.$row["id"].'" class="card" style="width: 24%;height:200px;float:left;margin:6px;background-color:white">
                <div class="card-body">
                    <h4 class="card-title">'.$row["word"].'</h4>
                    <p class="card-text">'.$row["meaning"].'</p><br><br>

                    <center><input type="checkbox" name="check_list[]" value="'.$row["word"].'"></center>
                </div>
            </div>

            ';

            
        }
    } else {
        echo "0 results";   
    }
?>

</form>

<?php
    if(isset($_POST['submit'])){//to run PHP script on submit

      if(!empty($_POST['check_list'])){
        
        $deck_name = $_POST["deck_name"];

        foreach($_POST['check_list'] as $selected){

          $sql_query = "UPDATE words SET deck='$deck_name' WHERE word='$selected'";

          if ($conn->query($sql_query) == TRUE) {

              echo '<script>alert("Deck Successfully Created")</script>';

    }   else  {

        }
      }
    }
  }
    
    $conn->close();
?>

<script type="text/javascript" src="../js/jquery.js"></script>

</body>
</html>
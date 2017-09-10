<?php

    session_start();

    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, question, option1, option2, option3, option4, answer FROM questions ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>View Test</title>
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

<br><hr>
<h4>Name :<?= $_SESSION['name'] ?></h4>
<h4>Username :<?= $_SESSION['username'] ?></h4>
<br><hr>

<?php
if ($result->num_rows > 0) {
    // output data of each row
      while($row = $result->fetch_assoc()) {

        echo '
          <form method="POST" action="view_test.php">
            <div class="card">
              <div class="card-body">
                <h4>'.$row["question"].'</h4>
              <input type="radio" name="ans" value="1"> '.$row["option1"].'<br>
              <input type="radio" name="ans" value="2"> '.$row["option2"].'<br>
              <input type="radio" name="ans" value="3"> '.$row["option3"].'<br>
              <input type="radio" name="ans" value="4"> '.$row["option4"].'<br>

              <button type="submit" name="ans_btn" class="btn btn-success">Submit Answer</button>
              </div>
            </div>
          </form>
        ';

        $correct_ans = $row['answer'];

        if(isset($_POST['ans_btn'])){
    $user_ans = $_POST['ans'];

    echo $user_ans;
    echo $correct_ans;

  if($user_ans == $correct_ans){
    echo '<h4>Correct answer</h4>';
  }

  else{
    echo '<h4>Wrong answer</h4>';
  }
  }

      }
  } else {
      echo "0 results"; 
  }
  
  $conn->close();
?>

</body>
</html>
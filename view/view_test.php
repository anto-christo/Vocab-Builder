<?php

    session_start();

    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, question, option1, option2, option3, option4, answer FROM questions WHERE review=1 ORDER BY RAND() LIMIT 5";
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

<form method="POST" action="view_test.php">

<?php
  
if ($result->num_rows > 0) {
    
    $test_answers = array();

    while($row = $result->fetch_assoc()) {

    echo '<div class="card">
     <div class="card-body">
      <h4>'.$row["question"].'</h4>
    <input type="radio" name="ans['.$row["id"].']" value="1"> '.$row["option1"].'<br>
    <input type="radio" name="ans['.$row["id"].']" value="2"> '.$row["option2"].'<br>
    <input type="radio" name="ans['.$row["id"].']" value="3"> '.$row["option3"].'<br>
    <input type="radio" name="ans['.$row["id"].']" value="4"> '.$row["option4"].'<br>
    </div>
  </div>';

    array_push($test_answers,$row["answer"]);

  }

}

else {
      echo "0 results"; 
  }

?>
    <br><center><button type="submit" name="ans_btn" class="btn btn-success">Submit Quiz</button></center><br><br>
</form>

<?php

    if(isset($_POST['ans_btn'])){

      $count = 0;

      foreach ($_POST['ans'] as $key => $new_val)
      {
        if (isset($test_answers[$key])) // belongs to old array?
        {
           if ($test_answers[$key] != $new_val) // has changed?
            $count++; // catch it
        }
      }

      $count++;

      $_SESSION['score'] = $count;

      header("location: test_score.php");
    }
  
  $conn->close();
?>

</body>
</html>
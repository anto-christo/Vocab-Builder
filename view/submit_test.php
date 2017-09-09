<?php
    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $question = $_POST["question"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $answer = $_POST["answer"];
    
    $sql = "INSERT INTO questions (question,option1,option2,option3,option4,answer) VALUES ('$question','$option1','$option2','$option3','$option4','$answer')";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Literature Professional</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

<form style="margin:40px 300px 0px 300px;" method="post" action="submit_test.php">
  <center>
    <div class="container" style="border:1px solid gray;padding: 30px">
      <div class="form-group row">
        <label for="question" class="col-sm-2 col-form-label">Question</label>
        
        <div class="col-sm-8">
          <textarea type="text" class="form-control" name="question" id="question" required></textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="option1" class="col-sm-2 col-form-label">Option 1</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="option1" id="option1" required>
          </div>
      </div>

      <div class="form-group row">
        <label for="option2" class="col-sm-2 col-form-label">Option 2</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="option2" id="option2" required>
          </div>
      </div>

      <div class="form-group row">
        <label for="option3" class="col-sm-2 col-form-label">Option 3</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="option3" id="option3" required>
          </div>
      </div>

      <div class="form-group row">
        <label for="option4" class="col-sm-2 col-form-label">Option 4</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="option4" id="option4" required>
          </div>
      </div>

      <div class="form-group row">
        <label for="answer" class="col-sm-2 col-form-label">Correct Answer</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" name="answer" id="answer" min="1" max="4" required>
          </div>
      </div>

      <button style="margin-top: 1px" type="submit" class="btn btn-info">Send To Editor</button>
    <div>
  </center>
  
</form>

<?php
if ($conn->query($sql) === TRUE) {
        echo'<center><button id="suc" style="margin-top:30px" class="btn btn-success">Successfully Sent</button></center';

    } else {
        echo'<center><button style="margin-top:30px" class="btn btn-danger">Error while submitting</button></center';
    }
    
    $conn->close();
?>

</body>
</html>
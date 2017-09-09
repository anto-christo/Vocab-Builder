<?php
    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $word = $_POST["word"];
    $meaning = $_POST["meaning"];
    
    $sql = "INSERT INTO words (word,meaning) VALUES ('$word','$meaning')";
    
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

<form style="margin:50px 300px 0px 300px;" method="post" action="submit_word.php">
<center>
  <div style="border:1px solid gray;padding: 30px">
    <div class="form-group row">
    <label for="word" class="col-sm-2 col-form-label">Word</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="word" id="word" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="meaning" class="col-sm-2 col-form-label">Meaning</label>
    <div class="col-sm-8">
      <textarea type="text" class="form-control" name="meaning" id="meaning" required></textarea>
    </div>
  </div>


  <button style="margin-top: 50px" type="submit" class="btn btn-info">Send To Editor</button>
  </div>
</center>
  
</form>

<?php
if ($conn->query($sql) == TRUE) {
        echo'<center><button style="margin-top:30px" class="btn btn-success">Successfully Sent</button></center';
    } else {
        echo'<center><button style="margin-top:30px" class="btn btn-danger">Error while submitting</button></center';
    }
    
    $conn->close();
?>

</body>
</html>
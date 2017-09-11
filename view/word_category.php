<?php
    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $get_decks = "SELECT name FROM decks";
    $res_decks = $conn->query($get_decks);

    $sql = "SELECT id,word,type,meaning,example FROM words WHERE deck=''";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Word Category</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

<form method="POST" action="word_category.php">

<center>


<form method="POST" action="word_category.php">
  <?php
  if($res_decks->num_rows > 0){
    while($row1 = $res_decks->fetch_assoc()){

      echo '
          <input type="radio" name="deck" value="'.$row1["name"].'">'.$row1["name"].'
      ';

    }

  }
  ?>

  <br><br><button name="submit" type="submit" class="btn btn-success">Create Decks</button>

<hr>
</center>

<?php
if ($result->num_rows > 0) {

    // output data of each row
        while($row = $result->fetch_assoc()) {


            $func_name = 'a'.$row["id"];
            $btn_id = 'b'.$row["id"];

            echo '

            <div id="'.$row["id"].'" class="card" style="width: 24%;height:400px;float:left;margin:6px;background-color:white">
                <div class="card-body">
                    <h4 class="card-title">'.$row["word"].'</h4>
                    <p class="card-text">'.$row["type"].'</p><br><br>
                    <p class="card-text">'.$row["meaning"].'</p><br><br>
                    <p class="card-text">'.$row["example"].'</p><br><br>


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
        
        $deck_name = $_POST['deck'];

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
<?php
    $conn = new mysqli ("localhost","root","","vocab_test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, question, option1, option2, option3, option4, answer FROM questions";
	$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Review Test</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

<?php
if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()) {

            $func_name = 'a'.$row["id"];
        	
        	echo '<center><div id="'.$row["id"].'" class="table table-striped table-inverse" style="width: 50%;height: 400px;border: 1px solid gray;border-radius: 25px;float:left;">
                <table width="600px" height="400px">
        <tr>
            <td>
                Question
            </td>
                
            <td>
                '.$row["question"].'
            </td>
        </tr>

        <tr>
            <td>
                Option 1
            </td>

            <td>
                '.$row["option1"].'
            </td>
        </tr>

        <tr>
            <td>
                Option 2
            </td>

            <td>
                '.$row["option2"].'
            </td>
        </tr>

        <tr>
            <td>
                Option 3
            </td>

            <td>
                '.$row["option3"].'
            </td>
        </tr>

        <tr>
            <td>
                Option 4
            </td>

            <td>
                '.$row["option4"].'
            </td>
        </tr>

        <tr>
            <td>
                Answer
            </td>
                
            <td>
                '.$row["answer"].'
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <center><button onclick="'.$func_name.'()" type="button" class="btn btn-info">Post</button></center>
            </td>
        </tr>
    </table>
                </div></center>';

        echo 
        '
            <script type="text/javascript">
                function '.$func_name.'(){
                    document.getElementById('.$row["id"].').style.display="none";
                }
            </script>
        ';
    	}
	} else {
    	echo "0 results";	
	}
	
	$conn->close();
?>

</body>
</html>
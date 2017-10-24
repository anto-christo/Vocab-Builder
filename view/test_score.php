<?php
	session_start();
	
	$score = 5-$_SESSION['score'];

	echo '
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

<center>
	<div style="margin:5%; border: 1px solid gray;padding:10px;background-color:black">
		<p style="font-size:50px;color:white">You Got</p>
		<p style="font-size:50px;color:white">'.$score.'/5</p>
		<p style="font-size:50px;color:white">Correct !!</p>
	</div>
	<br><br>

	<form method="POST" action="view_test.php">
	<button type="submit" class="btn btn-primary">Take Another Quiz ?</button>
	</form>
</center>

</body>
</html>
	';
?>
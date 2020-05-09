<?php
	require_once 'utilities.php';
	$outMessage="";
	if(isset($_GET['rating']))
	{
		$name=$_GET['name'];
		$rating=$_GET['rating'];
		$con = mysqli_connect('localhost', 'root', '', 'moviesDB');
		if(mysqli_errno($con))
			$outMessage.="error connecting to database: ".mysqli_error($con);
		$sqlQuery="INSERT INTO ratings VALUES('$name','$rating');";
		if(mysqli_query($con, $sqlQuery))
			$outMessage.= "added rating";
		else
		{
			if(mysqli_error($con)==="Cannot add or update a child row: a foreign key constraint fails (`moviesdb`.`ratings`, CONSTRAINT `movie_name_constraint` FOREIGN KEY (`movie_name`) REFERENCES `movies` (`name`))")
				$outMessage.="this movie doesnt exist";
			else
				$outMessage.="error adding rating: ".mysqli_error($con);
		}
		mysqli_close($con);
	}
?>

<html>
<head>
	<title>add ratings</title>
</head>
<body>
<h1>add ratings:<br/></h1>
<form action="addRating.php" method="get">
	name:<input type="text" name="name"><br/>
	rating:<input type="number" name="rating" max="10" min="1" value="5"><br/>
	<input type="submit" value="add rating"><br/>
</form>
<br/><?php echo $outMessage;?>
</body>
</html>
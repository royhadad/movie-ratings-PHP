<?php
	require_once 'utilities.php';
	$outMessage="";
	if(isset($_GET['name']))
	{
		$name=$_GET['name'];
		$genre=$_GET['genre'];
		$year=$_GET['year'];
		$con = mysqli_connect('localhost', 'root', '', 'moviesDB');
		if(mysqli_errno($con))
			$outMessage.="error connecting to database: ".mysqli_error($con);
		$sqlQuery="INSERT INTO movies VALUES('$name','$genre','$year');";
		if(mysqli_query($con, $sqlQuery))
			$outMessage.= "added movie";
		else 
		{
			$error1=mysqli_error($con);
			$error1=explode(' ', $error1);
			$error1=$error1['0'];
			if($error1==="Duplicate")
				$outMessage.="this movie already exists";
			else
				$outMessage.="error adding movie: ".mysqli_error($con);
		}
		mysqli_close($con);
	}
?>

<html>
<head>
	<title>add movies</title>
</head>
<body>
<h1>add movies:<br/></h1>
<form action="addMovie.php" method="get">
	name:<input type="text" name="name"><br/>
	genre:<?php echo getGenresDropDownList();?><br/>
	year:<input type="number" name="year" max="2020" min="1878" value="2010"><br/>
	<input type="submit" value="add movie"><br/>
</form>
<br/><?php echo $outMessage;?>
</body>
</html>
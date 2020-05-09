<?php
	require_once 'utilities.php';
	$moviesTable="";
	if(isset($_GET['maxYear']))
	{
		$genre=$_GET['genre'];
		$minYear=$_GET['minYear'];
		$maxYear=$_GET['maxYear'];
		
		$con = mysqli_connect('localhost', 'root', '', 'moviesDB');
		if(mysqli_errno($con))
			$outMessage.="error connecting to database for movies table: ".mysqli_error($con);
		$sqlQuery="SELECT * FROM movies WHERE genre='$genre' AND year>=$minYear AND year<=$maxYear;";
		$result=mysqli_query($con, $sqlQuery);
		if($result)
		{
			$moviesTable.="<table border='1' caption='movies'>";
			$moviesTable.="<tr><th>name</th><th>year</th><th>average rating</th></tr>";
			while($row=mysqli_fetch_array($result))
			{
				$name=$row['name'];
				$year=$row['year'];
				$moviesTable.="<tr><td>$name</td><td>$year</td><td>".getMovieAvgRating($name)."</td></tr>";
			}
			$moviesTable.="</table>";
		}
		else
			$outMessage.="error quering movies table: ".mysqli_error($con);
		mysqli_close($con);
	}
?>
<html>
<head>
	<title>search movies</title>
</head>
<body>
<h1>search movies:<br/></h1>
<form action="searchMovie.php" method="get">
	genre:<?php echo getGenresDropDownList();?><br/>
	minimum year:<input type="number" name="minYear" max="2020" min="1878" value="2000"><br/>
	maximum year:<input type="number" name="maxYear" max="2020" min="1878" value="2010"><br/>
	<input type="submit" value="search movies"><br/>
</form>
<br/><?php echo $moviesTable;?>
</body>
</html>
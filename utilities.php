<?php
	include_once 'mainMenu.html';
	function getGenresDropDownList()
	{
		$output="";
		$con = mysqli_connect('localhost', 'root', '', 'moviesDB');
		if(mysqli_errno($con))
			$outMessage.="error connecting to database for genres drop down list: ".mysqli_error($con);
		$sqlQuery="SELECT * FROM genres;";
		$result=mysqli_query($con, $sqlQuery);
		if($result)
		{
			$output.="<select name='genre'>";
			while($row=mysqli_fetch_array($result))
			{
				$genreName=$row['name'];
				$output.="<option value='$genreName'>$genreName</option>";	
			}
			$output.="<select/>";		
		}
		else
			$outMessage.="error quering drop down list from genres DB: ".mysqli_error($con);
		
		mysqli_close($con);
		return $output;
	}
	function getMovieAvgRating($movieName)
	{
		$avgRating=0.0;
		$con = mysqli_connect('localhost', 'root', '', 'moviesDB');
		if(mysqli_errno($con))
			$outMessage.="error connecting to database for getting average movie rating: ".mysqli_error($con);
		$sqlQuery="SELECT AVG(rating) AS avg_rating FROM ratings WHERE movie_name='$movieName';";
		$result=mysqli_query($con, $sqlQuery);
		if($result)
		{
			$row=mysqli_fetch_array($result);
			$avgRating=$row['avg_rating'];
		}
		else
			$outMessage.="error average movie rating: ".mysqli_error($con);
		mysqli_close($con);
		return $avgRating;
	}
?>
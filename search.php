<!DOCTYPE html!>

<html>
<head>
	<title> Sökresultat </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
	
	<!-- sök fönster -->
	<div class="searchbar">
		<form action="search.php" method="GET">
			<input type="text" name="query" placeholder="Sök här!"/>
			<input type="submit" value="Sök" />
		</form>
	</div>
</head>
<body>

<div class="header">
	<h1> Sökresultat </h1>
</div>
	<nav class="navigation">
		<ul>
			<a href="index.php"><li><p> Startsida</p> </li></a>
			<a href="courses.php"><li><p> Kurser</p> </li></a>
			<a href="summary.php"><li><p> Sammanfattningar</p> </li></a>
		</ul>
	</nav>

<?php
	mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
	mysql_select_db("studentplatform") or die(mysql_error());
?>
		<?php
			$query = $_GET['query']; 
			$min_length = 2;
			if(strlen($query) >= $min_length){
				 
				$query = htmlspecialchars($query); 
				$query = mysql_real_escape_string($query);
				$raw_results = mysql_query("SELECT * FROM summary
					WHERE (`content` LIKE '%".$query."%') OR (`title` LIKE '%".$query."%')")or die(mysql_error());
					
				
				if(mysql_num_rows($raw_results) > 0){ 
					
					
					while($results = mysql_fetch_array($raw_results)){
						echo '<div class="searchresult">'; 
						echo "<p>".$results['date']." </br>".$results['title']." </br>".$results['content']." </p>";
						echo '</div>';
					}
					
				}
				else{
					echo "Din sökning gav inget resultat!";
				}
			}
			else{
				echo "Minimum length is ".$min_length;
			}
		?>
	
</body>
</html>


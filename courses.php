<!DOCTYPE html!>

<html>
<head>
	<title> Kurser </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<div class="searchbar">
		<form action="search.php" method="GET">
			<input type="text" name="query" placeholder="Sök här!"/>
			<input type="submit" value="Sök" />
		</form>
	</div>
</head>
<body>

<div class="header">
	<h1> Kurser </h1>
</div>

	<nav class="navigation">
		<ul>
			<a href="index.php"><li> Startsida </li></a>
			<a href="courses.php"><li> Kurser </li></a>
			<a href="summary.php"><li> Sammanfattningar </li></a>
		</ul>
	</nav> 
	
	<?php
		// Värden för pdo
		$host     = "localhost";
		$dbname   = "studentplatform";
		$username = "studentplatform";
		$password = "12345";
		$dsn      = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
		$attr     = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

		// Skapa pdo
		$pdo = new PDO($dsn, $username, $password, $attr);
		
		//Skriva ut alla kurser
		echo '<div class="courses" style="overflow-y:scroll">';
		echo "<ul>";
			foreach ($pdo->query("SELECT id, coursename FROM courses ORDER BY coursename") as $row) {
				echo "<a href=\"?courses_id={$row['id']}\"><li></br>{$row['coursename']}</li></a>";
			}
		echo "</ul>";
		echo '</div>';
	?>
	
	<div class="summaries">
	<?php
	if(!empty($_GET))
	{
		// Om user klickat på en kurs, visa kursens sammanfattningar
		$_GET = null;
		$courses_id = filter_input(INPUT_GET, 'courses_id', FILTER_VALIDATE_INT);
		
		foreach($pdo->query("SELECT summary.*, courses.id FROM summary JOIN courses ON summary.courses_id=courses.id WHERE summary.courses_id=$courses_id") as $row)
		{
			echo '<div class="coursecontent" style="overflow-y:scroll" cols ="40" rows="10">';
			echo "<p> <h4> Skriven: </h4> {$row['date']} </br> <h4> Titel: </h4> {$row['title']} </br> <h4> Sammanfattning: </h4> {$row['content']} ";
			echo '</div>';
		}
	}
	?>
	</div>
	</nav>
	
	
</body>
</html>
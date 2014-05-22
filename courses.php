<!DOCTYPE html!>
<html>
<head>
	<title> Index </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />

</head>
<body>

<div class="header">
	<h1> Kurser </h1>
</div>

	<hr />

	<nav class="navigation">
		<ul>
			<li><a href="index.php"> Startsida </a></li>
			<li><a href="courses.php"> Kurser </a></li>
			<li><a href="summary.php"> Sammanfattningar </a></li>
		</ul>
	</nav>
	
	<hr />
	
	<div class="searchform">
	<form action="search.php" method="GET">
		<input type="text" name="query" placeholder="Sök här!"/>
		<input type="submit" value="Sök" />
	</form>
	</div>
	
	
	<div class="courses">
	<nav>
	
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

		echo "<ul>";
			foreach ($pdo->query("SELECT id, coursename FROM courses ORDER BY coursename") as $row) {
				echo "<li><a href=\"?courses_id={$row['id']}\">{$row['coursename']}</a></li>";
			}
		echo "</ul>";

	?>
	
	</div>
	
	<div class="summaries">
	<?php
	if(!empty($_GET))
	{
		// Om user klickat på en kurs, visa kursens sammanfattningar
		$_GET = null;
		$courses_id = filter_input(INPUT_GET, 'courses_id', FILTER_VALIDATE_INT);
		
		foreach($pdo->query("SELECT summary.*, courses.id FROM summary JOIN courses ON summary.courses_id=courses.id WHERE summary.courses_id=$courses_id") as $row)
		{
			echo "<p> <h4> Skriven: </h4> {$row['date']} </br> <h4> Titel: </h4> {$row['title']} </br> <h4> Sammanfattning: </h4> {$row['content']} <hr />";
		}
	}
	?>
	</div>
	</nav>
	<hr />
</body>
</html>
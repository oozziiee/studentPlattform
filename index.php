<!DOCTYPE html!>

<html>
<head>
	<title> Index </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
	<div class="searchbar">
		<form action="search.php" method="GET">
			<input type="text" name="query" placeholder="Sök här!"/>
			<input type="submit" value="Sök" />
		</form>
	</div>
</head>
<body>

<div class="header">
	<h1> Startsida </h1>
</div>
	<nav class="navigation">
		<ul>
			<a href="index.php"><li><p> Startsida </p></li></a>
			<a href="courses.php"><li><p> Kurser </p> </li></a>
			<a href="summary.php"><li><p> Sammanfattningar</p> </li></a>
		</ul>
	</nav>
	
	<?php
	// värden för pdo
	$host     = "localhost";
	$dbname   = "studentplatform";
	$username = "studentplatform";
	$password = "12345";
	$dsn      = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
	$attr     = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

	"<div class=\"resultat\">";
	
	// skapa pdo
	$pdo = new PDO($dsn, $username, $password, $attr);
	
	//antal summaries variabel
	$numsummaries = 0;
		//skriver ut antalet summaries som finns 
		foreach ($pdo->query("SELECT title FROM summary") as $row) {
				$numsummaries ++;
			}
		echo '<div class="summarycount">';
		echo "<h3>Antal sammanfattningar på sidan:</h2>";
		echo "<p>$numsummaries</p>";
		echo '</div>';
	?>
	<?php
	//antal kurser variabel
	$numcourses = 0;
		//skriver ut antalet kurser som finns 
		foreach ($pdo->query("SELECT coursename FROM courses") as $row) {
				$numcourses ++;
			}
		echo '<div class="coursescount">';
		echo "<h3>Antal kurser på sidan:</h2>";
		echo "<p>$numcourses</p>";
		echo '</div>';
	?>
	</div>
</body>
</html>
<!DOCTYPE html!>

<html>
<head>
	<title> Sammanfattningar </title>
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
	<h1> Sammanfattningar </h1>
</div>

	<nav class="navigation">
		<ul>
			<a href="index.php"><li> Startsida </li></a>
			<a href="courses.php"><li> Kurser </li></a>
			<a href="summary.php"><li> Sammanfattningar </li></a>
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

	// skapa pdo
	$pdo = new PDO($dsn, $username, $password, $attr);
?>
	
	
	<?php 
	// Skrivit något i textfältet? Posta till databasen
		if(!empty($_POST))	
		{
			$_POST = null;
			$courses_id = filter_input(INPUT_POST, 'courses_id', FILTER_VALIDATE_INT);
			$summary    = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
			$title	    = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW); 
			$statement  = $pdo->prepare("INSERT INTO summary (courses_id, content, date, title) VALUES (:courses_id, :content, NOW(), :title)");
			$statement  ->bindParam(":title", $title);
			$statement  ->bindParam(":courses_id", $courses_id);
			$statement  ->bindParam(":content", $summary);
			$statement  ->execute();
		}
	?> 
	
	<!-- Gör textfält + Dropdown med alla kurser -->
	
	<h3>Skriv ny sammanfattning</h3>
	<form action="summary.php" method="POST">
	<select name="courses_id" value="$courses_id">
	
	<?php
		foreach ($pdo->query("SELECT * FROM courses ORDER BY coursename") as $row) {
			echo "<option value=\"{$row['id']}\">{$row['coursename']}</option>";
		}	
	?>	
	
	<textarea name="summary" value="$summary" rows="10" cols="50" placeholder="Skriv din sammanfattning här!" ></textarea>
	<input type="text" name="title" placeholder="Skriv din titel här!">
	<input type="submit" value="Post" />
	</form>

</body>
</html>
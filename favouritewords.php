<!doctype html>

<html lang="en">
<head>
 	<meta charset="utf-8">

  	<title>Favourite Words</title>

	<style type="text/css">
	body {
		color: green;
	}
	</style>


</head>

<body>
<?php

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query =" SELECT word FROM word ".
		"WHERE wordid >= ( ". 
		"SELECT FLOOR( MAX( wordid ) * RAND( ) ) ". 
		"FROM word ) ".
		"ORDER BY wordid ".
		"LIMIT 1";	

	$result = mysqli_query($dbc, $query);
  	while ($row = mysqli_fetch_assoc($result)) {
  		$word = $row['word'];
		mysqli_close($dbc);
	}
	
	echo '<p>' . $word . '</p>';

?>


</body>
</html>

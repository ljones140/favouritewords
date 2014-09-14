<?php

require('connections.php'); 


        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query ="SELECT font FROM font ".
                "WHERE fontid >= ( ".
                "SELECT FLOOR( MAX( fontid ) * RAND( ) ) ".
                "FROM font ) ".
                "ORDER BY fontid ".
                "LIMIT 1";

        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_assoc($result)) {
                $font = $row['font'];
                mysqli_close($dbc);
        }



?>


<!doctype html>

<html lang="en">
<head>
 	<meta charset="utf-8">

  	<title>Favourite Words</title>

	<style type="text/css">
	p {
		color: green;
		<?php echo $font; ?>
		margin-right: auto;
		margin-left: auto;
		margin-top: auto;
		margin-bottom: auto;
		width: 6em;

	}
	</style>


</head>

<body>
<?php

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query ="SELECT word FROM word ".
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

//	echo $font;

?>


</body>
</html>

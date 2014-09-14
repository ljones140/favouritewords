<?php

	$page = $_SERVER['PHP_SELF'];
        $sec = "2";
        header("Refresh: $sec; url=$page");

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
	.word {
		font-size: 50pt;
		color: green;
		<?php echo $font; ?>
		margin: auto;
		position: absolute;
  		top: 35%; 
  		left: 50%; 
  		bottom: 65%; 
  		right: 50%;



	/*	margin: 50%; */
	/*	margin-right: auto; */
	/*	margin-left: auto; */
	/*	margin-top: auto; */
	/*	margin-bottom: auto; */
	/*	width: 6em; */

	}
	</style>


</head>

<body>

	<div class="word">
<?php
	
	//get the count of words to do random calc

	
//	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//	$query = "SELECT count(*) FROM word";

//	$result = mysqli_query($dbc, $query);
//	while ($row = mysqli_query($dbc, $query)

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
	</div>


</body>
</html>

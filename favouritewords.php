<?php

	$page = $_SERVER['PHP_SELF'];
        $sec = "2";
        header("Refresh: $sec; url=$page");

	require('connections.php'); 
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT count(*) as fontcount FROM font";
        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_assoc($result)){
                $fontcount = $row['fontcount'];

        }
        
        mysqli_close($dbc);

        $randfont = mt_rand(1,$fontcount);

	

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query ="SELECT font FROM font WHERE fontid = $randfont ";

        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_assoc($result)) {
                $font = $row['font'];
        }

        mysqli_close($dbc);


?>


<!doctype html>

<html lang="en">
<head>
 	<meta charset="utf-8">

  	<title>Favourite Words</title>

	<style type="text/css">
	.word {
		font-size: 100pt;
		color: green;
		<?php echo $font; ?>
		margin: auto;
		position: absolute; 
  		top: 20%; 
  		left: 40%; 
  		bottom: 80%; 
  		right: 60%;



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

	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT count(*) as wordcount FROM word";
	$result = mysqli_query($dbc, $query);
	while ($row = mysqli_fetch_assoc($result)){
		$wordcount = $row['wordcount'];
		
	}
	
	mysqli_close($dbc);

	$randword = mt_rand(1,$wordcount);

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query ="SELECT word FROM word ".
		"WHERE wordid = $randword"; 

	$result = mysqli_query($dbc, $query);
  	while ($row = mysqli_fetch_assoc($result)) {
  		$word = $row['word'];
	}
	
	mysqli_close($dbc);
	
	echo '<p>' . $word . '</p>';

//	echo $font;

?>
	</div>


</body>
</html>

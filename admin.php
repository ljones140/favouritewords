
<!doctype html>

<html lang="en">
<head>
 	<meta charset="utf-8">

  	<title>Favourite Words admin</title>

</head>
<body>
	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        	$query = "SELRCT wordid, word FROM word";
        	$result = mysqli_query($dbc, $query);
        	while ($row = mysqli_fetch_assoc($result)){
			echo '<input type="checkbox" value="' . $row['wordid']. '"name="todelete[]"/>';
			echo ' ' . $row['word'];
			echo '<br />';
        }
	
	mysqli_close($dbc);

?>

	
		<input type="submit" name="submit" value="remove" />
	</form>

</body>
</html>

<?php

require('connections.php');

session_start();

  // If the session vars aren't set, try to set them with a cookie
 	if (!isset($_SESSION['user_id'])) {
    		if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      			$_SESSION['user_id'] = $_COOKIE['user_id'];
      			$_SESSION['username'] = $_COOKIE['username'];
    		}
 	 }


?>


<!doctype html>

<html lang="en">
<head>
 	<meta charset="utf-8">

  	<title>Favourite Words admin</title>

</head>
<body>

	<h1>Favourite Word Admin Page</h1>

<?php

	if (!isset($_SESSION['user_id'])) {
    		echo '<p>Please <a href="login.php">log in</a> to access this page.</p>';
    		exit();
  	}
	else {
    		echo('<p>You are logged in as ' . $_SESSION['username'] . '</p>');
  	}

	
	if(isset($_POST['newword'])){
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$newword = mysqli_real_escape_string($dbc, $_POST['newword']);
		if (!empty($newword)){
			$query = "SELECT * FROM word where word = '$newword'";
			$result  = mysqli_query($dbc, $query);
			if(mysqli_num_rows($result) > 0) {
				echo '<h2>Word Already Exists</p>';
			}
			else {
				$query = "INSERT INTO word (word) values ('$newword')";
				mysqli_query($dbc, $query) or die ('Error Querying Database');
			
				echo '<p>New Word Added: ' . $newword . '</p>';
			}
			mysqli_close($dbc);
		}
		else {
			echo '<p>Your word is Empty Dummy!!!</p>';
		}
	}		




?>

	<h2>Enter New Words</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"id="newword" >
	<input type="text" name="newword">
	<input type="submit">
	</form>


	<h2>Select words to remove</h2>	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="todelete" >

<?php

	if(isset($_POST['todelete'])){
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		foreach ($_POST['todelete'] as $delete_id){
			$query = "DELETE FROM word WHERE wordid = $delete_id";
			mysqli_query($dbc, $query) or die ('Error Querying Database');
		}

		echo '<p>Words removed</p>';
		mysqli_close($dbc);
	}



	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        	$query = "SELECT wordid, word FROM word ORDER BY word";
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

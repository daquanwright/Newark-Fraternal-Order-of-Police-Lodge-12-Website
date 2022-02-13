<?php
	session_start();

	define('MyConst', TRUE);

	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
	    $session = $_SESSION["user_id"];

	    include('databaselogin.php');

	    $conn = mysqli_connect($servername, $db_user, $db_pass, $database);

	    if(!$conn) {
	    	die("Connection failed" . mysqli_connect_error());
	    }

	    $query = "SELECT * FROM logins WHERE session = '$session'";

	    $data = mysqli_query($conn, $query);

	    if(!$data) {
	    	$status_err = "Failed to connect";
	    } else {
	    	$rows = mysqli_fetch_assoc($data);
	      
		    if($rows >= 1) {
		    	if($rows['officer'] == 1) {
		    		require('policenav.php');
		    	} else {
		    		require('membernav.php');
		    	}
			}
		}
	} else {
		require('nav.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title>Newark FOP Events</title>
		<link rel="stylesheet" type="text/css" href="eventstyle.css">
		<link rel="stylesheet" type="text/css" href="homestyle.css">
	 <div class="main_container">
</head>
<body>
	<div class="banner">
	</div>
	<center><h1>EVENTS CALENDAR</h1></center>
	<div>
		<center><iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23039BE5&amp;ctz=America%2FNew_York&amp;src=bmV3YXJrcG9saWNlZm9wQGdtYWlsLmNvbQ&amp;color=%23039BE5&amp;showTabs=0&amp;showCalendars=1&amp;showNav=1" style="border-width:0" width="700" height="500" frameborder="0" scrolling="no"></iframe></center>
	</div>
	<br>
</body>
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</html>

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
		    		header("Location: memberpage.php");
		    	}
			} else {
				header("Location: login.php");
			}
		}
	} else {
		header("Location: login.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Newark FOP Active Police</title>
	<link rel="stylesheet" type="text/css" href="policestyle.css">
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<div class="main_container">
</head>
<body>
	<div class="banner">
		<img class="banner-image" src="fopbanner.jpg">
	</div>
	<center><h1>ACTIVE POLICE PAGE</h1></center>
    
    
    <div class="about">

        <!DOCTYPE html>
    <center><p>Please review the <a href="FOPcontract.pdf">FOP Contract</a></p></center>
  </body>
</html>
                    
                
    </div>



<div 
class="seal"><img  src="seal.png"
class="logo1"><img  src="logo.png"
class="pol"><img  src="plogo.png"
    
    ></div>
    <div>
		<center><iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23039BE5&amp;ctz=America%2FNew_York&amp;src=bmV3YXJrcG9saWNlZm9wQGdtYWlsLmNvbQ&amp;color=%23039BE5&amp;showTabs=0&amp;showCalendars=1&amp;showNav=1" style="border-width:0" width="700" height="500" frameborder="0" scrolling="no"></iframe></center>
	</div>


</body>
<!-- Footer -->
<div class="footer">
	<div class="footer-image">
		<img class="seniorprojectlogo" src="seniorprojectlogo.png">
	</div>
	<div class="footer-bottom">
		Copyright &copy; 2020, All Rights Reserved.<br> Rutgers Newark Computer Science
	</div>
</div>
<!-- /Footer -->
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</html>

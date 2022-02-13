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
		<title>Newark FOP Change Password</title>
		<link rel="stylesheet" type="text/css" href="resetstyle.css">
		<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
		<div class="banner">
			<img class="banner-image" src="fopbanner.jpg">
		</div>

		<h1>CHANGE PASSWORD</h1>

		<?php
			$email = $old_password = $new_password = $confirm = $captcha = "";
			$old_password_err = $new_password_err = $confirm_err = $status_err = $captcha_err = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["old_password"])) {
					$old_password_err = "Old password is required";
				} else {
					$old_password = $_POST["old_password"];
					$old_pass = md5($old_password);
					if($old_pass != $rows['password']) {
						$old_password_err = "Old password is incorrect";
					}
				}

				if (empty($_POST["new_password"])) {
					$new_password_err = "New password is required";
				} else {
				    $new_password = $_POST["new_password"];
				    if((strlen($new_password) < 8) || (strlen($new_password) > 12)) {
						$new_password_err = "New password must be 8-12 characters";
					} else {
						if (!preg_match("/[A-Z]+/", $new_password)) {
							$new_password_err .= "An uppercase letter is required <br>";
						}
						if (!preg_match("/[a-z]+/", $new_password)) {
							$new_password_err .= "A lowercase letter is required <br>";
						}
						if (!preg_match("/[0-9]+/", $new_password)) {
							$new_password_err .= "A number is required <br>";
						}
						if (!preg_match("/[_\W]+/", $new_password)) {
							$new_password_err .= "A special character is required <br>";
						}
					}
				}

				if (empty($_POST["confirm"])) {
					$confirm_err = "Password confirmation is required";
				} else {
				    $confirm = $_POST["confirm"];
				    if (!($confirm == $new_password)) {
				    	$confirm_err = "Password does not match";
				    }
				}

				if(isset($_POST['g-recaptcha-response'])) {
				    $captcha = $_POST['g-recaptcha-response'];
				}
				if(!$captcha) {
				    $captcha_err = "Please check the captcha";
				}


				if ($old_password_err == "" && $new_password_err == "" && $confirm_err == "" && $captcha_err == "") {
					$email = $rows['email'];

					include('databaselogin.php');

					$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

					if(!$conn) {
						die("Connection failed" . mysqli_connect_error());
					}

					$new_pass = md5($new_password);

					$update_query = "UPDATE logins SET password = '$new_pass' WHERE email = '$email'";
					$data = mysqli_query($conn, $update_query);

					if(!$data) {
						$status_err = "Failed to connect";
					} else {
						echo '<script language="javascript">';
						echo 'alert("Password reset was successfully");';
						echo 'window.location="login.php"';
						echo '</script>';
					}

					mysqli_close($conn);
				}
			}

			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>

		<div class="container">
		    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<label for="old_password">Old password: *</label><br>
				<input type="password" name="old_password" placeholder="Old password...">
				<span class="error"><i><?php echo $old_password_err;?></i></span><br><br>

		    	<label for="new_password">New password: *</label><br>
				<input type="password" name="new_password" placeholder="New password...">
				Password must be 8-12 characters and include:<br>
				A uppercase letter<br>
				A lowercase letter<br>
				A number<br>
				A special character<br>
				<span class="error"><i><?php echo $new_password_err;?></i></span><br><br>

				<label for="confirm">Confirm password: *</label><br>
				<input type="password" name="confirm" placeholder="Confirm password...">
				<span class="error"><i><?php echo $confirm_err;?></i></span><br><br>

				<div class="g-recaptcha" data-sitekey="6LdXtOUUAAAAAMS-KfqG7PceyB4AQFQKmvOQCGgl"></div><br>
				<span class="error"><i><?php echo $captcha_err;?></i></span><br><br>

				<input type="submit" value="Submit">
				<center>* Required Fields</center>
				<span class="error"><i><?php echo $status_err;?></i></span>
			</form>
		</div>

		<br><br>

		<div class="footer">
			<div class="footer-image">
				<img class="seniorprojectlogo" src="seniorprojectlogo.png">
			</div>
			<div class="footer-bottom">
				Copyright &copy; 2020, All Rights Reserved.<br> Rutgers Newark Computer Science
			</div>
		</div>
	</body>
	<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</html>
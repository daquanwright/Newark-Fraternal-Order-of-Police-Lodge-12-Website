<?php
session_start();

define('MyConst', TRUE);

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
	$session = $_SESSION["user_id"];

	include('databaselogin.php');

	$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

	if (!$conn) {
		die("Connection failed" . mysqli_connect_error());
	}

	$query = "SELECT * FROM logins WHERE session = '$session'";

	$data = mysqli_query($conn, $query);

	if (!$data) {
		$status_err = "Failed to connect";
	} else {
		$rows = mysqli_fetch_assoc($data);

		if ($rows >= 1) {
			if ($rows['officer'] == 1) {
				header('Location: police.php');
			} else {
				header('Location: memberpage.php');
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
	<title>Newark FOP Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="forgotstyle.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="homestyle.css">
	<!-- Bootstrap and CSS-->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet"></head>

<body>
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12 mt-4">
				<h3>Forgot Username or Password</h3>
				<?php
				$email = $email_err = $status_err = "";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (empty($_POST["email"])) {
						$email_err = "Email is required";
					} else {
						$email = test_input($_POST["email"]);
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$email_err = "Invalid email format";
						}
					}

					if ($email_err == "") {
						include('databaselogin.php');

						$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

						if (!$conn) {
							die("Connection failed" . mysqli_connect_error());
						}

						$query = "SELECT * FROM logins WHERE email = '$email'";
						$data = mysqli_query($conn, $query);

						if (!$data) {
							$status_err = "Failed to connect";
						}

						$rows = mysqli_fetch_assoc($data);

						if ($rows >= 1) {
							if ($email == $rows['email']) {
								$pass = generatePassword(12, 2, 2, 2);

								$header = "From: newarkpolicefop@gmail.com" . "\r\n";
								$msg = "Username: " . $rows['username'] . "\nPassword: " . $pass;

								$password = md5($pass);

								$update_query = "UPDATE logins SET password = '$password' WHERE email = '$email'";
								$data = mysqli_query($conn, $update_query);

								if (!$data) {
									$status_err = "Failed to connect";
								} else {
									if (mail($email, "Password Reset", $msg, $header)) {
										echo '<script language="javascript">';
										echo 'alert("Email sent");';
										echo 'window.location="login.php"';
										echo '</script>';
									} else {
										$status_err = "Error sending email";
									}
								}
							}
						}

						mysqli_close($conn);
					}
				}

				function test_input($data)
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}

				function generatePassword($l = 8, $c = 0, $n = 0, $s = 0)
				{
					// get count of all required minimum special chars
					$count = $c + $n + $s;

					// sanitize inputs; should be self-explanatory
					if (!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
						trigger_error('Argument(s) not an integer', E_USER_WARNING);
						return false;
					} elseif ($l < 0 || $l > 12 || $c < 0 || $n < 0 || $s < 0) {
						trigger_error('Argument(s) out of range', E_USER_WARNING);
						return false;
					} elseif ($c > $l) {
						trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
						return false;
					} elseif ($n > $l) {
						trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
						return false;
					} elseif ($s > $l) {
						trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
						return false;
					} elseif ($count > $l) {
						trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
						return false;
					}

					// all inputs clean, proceed to build password

					// change these strings if you want to include or exclude possible password characters
					$chars = "abcdefghijklmnopqrstuvwxyz";
					$caps = strtoupper($chars);
					$nums = "0123456789";
					$syms = "!@#$%^&*()-+?";

					// build the base password of all lower-case letters
					for ($i = 0; $i < $l; $i++) {
						$out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
					}

					// create arrays if special character(s) required
					if ($count) {
						// split base password to array; create special chars array
						$tmp1 = str_split($out);
						$tmp2 = array();

						// add required special character(s) to second array
						for ($i = 0; $i < $c; $i++) {
							array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
						}
						for ($i = 0; $i < $n; $i++) {
							array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
						}
						for ($i = 0; $i < $s; $i++) {
							array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
						}

						// hack off a chunk of the base password array that's as big as the special chars array
						$tmp1 = array_slice($tmp1, 0, $l - $count);
						// merge special character(s) array with base password array
						$tmp1 = array_merge($tmp1, $tmp2);
						// mix the characters up
						shuffle($tmp1);
						// convert to string for output
						$out = implode('', $tmp1);
					}

					return $out;
				}
				?>


				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<label for="email">Email (required): </label>
					<input type="text" id="email" name="email" placeholder="Your email address..." value="<?php echo $email; ?>">
					<span class="error"><i><?php echo $email_err; ?></i></span><br>

					<input type="submit" value="Submit">
					<span class="error"><i><?php echo $status_err; ?></i></span>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
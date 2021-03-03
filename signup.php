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
	<title>Newark FOP Sign Up</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="homestyle.css">
	<!-- Bootstrap and CSS-->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- Captcha -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
	<div class="container boxes-index">
		<div class="row p-5">
		<h3>Sign Up</h3>
		<br>
		<span class="align-bottom">  * Required Fields</span>
		<?php
		$first_name = $last_name = $address = $city = $state = $zip = $phone = $email = $username = $password = $confirm = $captcha = "";
		$first_name_err = $last_name_err = $address_err = $city_err = $state_err = $zip_err = $phone_err = $email_err = $username_err = $password_err = $confirm_err = $captcha_err = $status_err = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["first_name"])) {
				$first_name_err = "First name is required";
			} else {
				$first_name = test_input($_POST["first_name"]);
				if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
					$first_name_err = "Only letters allowed";
				}
			}

			if (empty($_POST["last_name"])) {
				$last_name_err = "Last name is required";
			} else {
				$last_name = test_input($_POST["last_name"]);
				if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
					$last_name_err = "Only letters allowed";
				}
			}

			if (empty($_POST["address"])) {
				$address_err = "Address is required";
			} else {
				$address = test_input($_POST["address"]);
				if (!preg_match("/^[0-9 a-zA-Z.]*$/", $address)) {
					$address_err = "Invalid address format";
				}
			}

			if (empty($_POST["city"])) {
				$city_err = "City is required";
			} else {
				$city = test_input($_POST["city"]);
				if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
					$city_err = "Only letters allowed";
				}
			}

			if (empty($_POST["state"])) {
				$state_err = "State is required";
			} else {
				$state = test_input($_POST["state"]);
			}

			if (empty($_POST["zip"])) {
				$zip_err = "Zip code is required";
			} else {
				$zip = test_input($_POST["zip"]);
				if (!is_numeric($zip)) {
					$zip_err = "Only numbers allowed";
				}
				if (strlen($zip) != 5) {
					$zip_err = "The zip code entered was not 5 digits long";
				}
			}

			if (empty($_POST["phone"])) {
				$phone = "";
			} else {
				$phone = test_input($_POST["phone"]);
				if (!is_numeric($phone)) {
					$phone_err = "Only numbers allowed";
				}
				if (strlen($phone) != 10) {
					$phone_err = "The number entered was not 10 digits long";
				}
			}


			if (empty($_POST["email"])) {
				$email_err = "Email is required";
			} else {
				$email = test_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$email_err = "Invalid email format";
				} else {
					include('databaselogin.php');

					$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

					if (!$conn) {
						die("Connection failed" . mysqli_connect_error());
					}

					$query = "SELECT * FROM logins WHERE email = '$email'";

					$data = mysqli_query($conn, $query);

					if (!$data) {
						$status_err = "Failed to connect";
					} else {
						$rows = mysqli_fetch_assoc($data);

						if ($rows >= 1) {
							$email_err = "This email is already taken";
						}
					}

					mysqli_close($conn);
				}
			}

			if (empty($_POST["username"])) {
				$username_err = "Username is required";
			} else {
				$username = test_input($_POST["username"]);
				if ((strlen($username) < 5) || (strlen($username) > 12)) {
					$username_err = "Username must be 5-12 characters";
				} else {
					if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
						$username_err = "Only letters and numbers allowed";
					} else {
						include('databaselogin.php');

						$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

						if (!$conn) {
							die("Connection failed" . mysqli_connect_error());
						}

						$query = "SELECT * FROM logins WHERE username = '$username'";

						$data = mysqli_query($conn, $query);

						if (!$data) {
							$status_err = "Failed to connect";
						} else {
							$rows = mysqli_fetch_assoc($data);

							if ($rows >= 1) {
								$username_err = "This username is already taken";
							}
						}

						mysqli_close($conn);
					}
				}
			}

			if (empty($_POST["password"])) {
				$password_err = "Password is required";
			} else {
				$password = $_POST["password"];
				if ((strlen($password) < 8) || (strlen($password) > 12)) {
					$password_err = "Password must be 8-12 characters";
				} else {
					if (!preg_match("/[A-Z]+/", $password)) {
						$password_err .= "An uppercase letter is required <br>";
					}
					if (!preg_match("/[a-z]+/", $password)) {
						$password_err .= "A lowercase letter is required <br>";
					}
					if (!preg_match("/[0-9]+/", $password)) {
						$password_err .= "A number is required <br>";
					}
					if (!preg_match("/[_\W]+/", $password)) {
						$password_err .= "A special character is required <br>";
					}
				}
			}

			if (empty($_POST["confirm"])) {
				$confirm_err = "Password confirmation is required";
			} else {
				$confirm = $_POST["confirm"];
				if (!($confirm == $password)) {
					$confirm_err = "Password does not match";
				}
			}

			if (isset($_POST['g-recaptcha-response'])) {
				$captcha = $_POST['g-recaptcha-response'];
			}
			if (!$captcha) {
				$captcha_err = "Please check the captcha";
			}

			if ($first_name_err == "" && $last_name_err == "" && $address_err == "" && $city_err == "" && $state_err == "" && $zip_err == "" && $phone_err == "" && $email_err == "" && $username_err == "" && $password_err == "" && $confirm_err == "") {
				include('databaselogin.php');

				$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

				if (!$conn) {
					die("Connection failed" . mysqli_connect_error());
				}

				$pass = md5($password);

				$insert_query = "INSERT INTO logins (first_name, last_name, address, city, state, zip, phone, email, username, password) VALUES ('$first_name', '$last_name', '$address', '$city', '$state', '$zip', '$phone', '$email', '$username', '$pass')";

				$data = mysqli_query($conn, $insert_query);

				if (!$data) {
					$status_err = "Failed to connect";
				} else {
					echo '<script language="javascript">';
					echo 'alert("Registration was successfully");';
					echo 'window.location="login.php"';
					echo '</script>';
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
		?>


		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label for="first_name">First Name: *</label><br>
			<input type="text" id="first_name" name="first_name" placeholder="Your first name..." value="<?php echo $first_name; ?>">
			<span class="error"><i><?php echo $first_name_err; ?></i></span><br><br>

			<label for="last_name">Last Name: *</label><br>
			<input type="text" id="last_name" name="last_name" placeholder="Your last name..." value="<?php echo $last_name; ?>">
			<span class="error"><i><?php echo $last_name_err; ?></i></span><br><br>

			<label for="address">Address: *</label><br>
			<input type="text" id="address" name="address" placeholder="Your address..." value="<?php echo $address; ?>">
			<span class="error"><i><?php echo $address_err; ?></i></span><br><br>

			<label for="city">City: *</label><br>
			<input type="text" id="city" name="city" placeholder="City..." value="<?php echo $city; ?>">
			<span class="error"><i><?php echo $city_err; ?></i></span><br><br>

			<label for="state">State: *</label><br>
			<select name="state">
				<option hidden disabled selected value>Select a state</option>
				<option <?php if ($state == "AL") echo "selected"; ?> value="AL">Alabama</option>
				<option <?php if ($state == "AK") echo "selected"; ?> value="AK">Alaska</option>
				<option <?php if ($state == "AZ") echo "selected"; ?> value="AZ">Arizona</option>
				<option <?php if ($state == "AR") echo "selected"; ?> value="AR">Arkansas</option>
				<option <?php if ($state == "CA") echo "selected"; ?> value="CA">California</option>
				<option <?php if ($state == "CO") echo "selected"; ?> value="CO">Colorado</option>
				<option <?php if ($state == "CT") echo "selected"; ?> value="CT">Connecticut</option>
				<option <?php if ($state == "DE") echo "selected"; ?> value="DE">Delaware</option>
				<option <?php if ($state == "DC") echo "selected"; ?> value="DC">District of Columbia</option>
				<option <?php if ($state == "FL") echo "selected"; ?> value="FL">Florida</option>
				<option <?php if ($state == "GA") echo "selected"; ?> value="GA">Georgia</option>
				<option <?php if ($state == "HI") echo "selected"; ?> value="HI">Hawaii</option>
				<option <?php if ($state == "ID") echo "selected"; ?> value="ID">Idaho</option>
				<option <?php if ($state == "IL") echo "selected"; ?> value="IL">Illinois</option>
				<option <?php if ($state == "IN") echo "selected"; ?> value="IN">Indiana</option>
				<option <?php if ($state == "IA") echo "selected"; ?> value="IA">Iowa</option>
				<option <?php if ($state == "KS") echo "selected"; ?> value="KS">Kansas</option>
				<option <?php if ($state == "KY") echo "selected"; ?> value="KY">Kentucky</option>
				<option <?php if ($state == "LA") echo "selected"; ?> value="LA">Louisiana</option>
				<option <?php if ($state == "ME") echo "selected"; ?> value="ME">Maine</option>
				<option <?php if ($state == "MD") echo "selected"; ?> value="MD">Maryland</option>
				<option <?php if ($state == "MA") echo "selected"; ?> value="MA">Massachusetts</option>
				<option <?php if ($state == "MI") echo "selected"; ?> value="MI">Michigan</option>
				<option <?php if ($state == "MN") echo "selected"; ?> value="MN">Minnesota</option>
				<option <?php if ($state == "MS") echo "selected"; ?> value="MS">Mississippi</option>
				<option <?php if ($state == "MO") echo "selected"; ?> value="MO">Missouri</option>
				<option <?php if ($state == "MT") echo "selected"; ?> value="MT">Montana</option>
				<option <?php if ($state == "NE") echo "selected"; ?> value="NE">Nebraska</option>
				<option <?php if ($state == "NV") echo "selected"; ?> value="NV">Nevada</option>
				<option <?php if ($state == "NH") echo "selected"; ?> value="NH">New Hampshire</option>
				<option <?php if ($state == "NJ") echo "selected"; ?> value="NJ">New Jersey</option>
				<option <?php if ($state == "NM") echo "selected"; ?> value="NM">New Mexico</option>
				<option <?php if ($state == "NY") echo "selected"; ?> value="NY">New York</option>
				<option <?php if ($state == "NC") echo "selected"; ?> value="NC">North Carolina</option>
				<option <?php if ($state == "ND") echo "selected"; ?> value="ND">North Dakota</option>
				<option <?php if ($state == "OH") echo "selected"; ?> value="OH">Ohio</option>
				<option <?php if ($state == "OK") echo "selected"; ?> value="OK">Oklahoma</option>
				<option <?php if ($state == "OR") echo "selected"; ?> value="OR">Oregon</option>
				<option <?php if ($state == "PA") echo "selected"; ?> value="PA">Pennsylvania</option>
				<option <?php if ($state == "RI") echo "selected"; ?> value="RI">Rhode Island</option>
				<option <?php if ($state == "SC") echo "selected"; ?> value="SC">South Carolina</option>
				<option <?php if ($state == "SD") echo "selected"; ?> value="SD">South Dakota</option>
				<option <?php if ($state == "TN") echo "selected"; ?> value="TN">Tennessee</option>
				<option <?php if ($state == "TX") echo "selected"; ?> value="TX">Texas</option>
				<option <?php if ($state == "UT") echo "selected"; ?> value="UT">Utah</option>
				<option <?php if ($state == "VT") echo "selected"; ?> value="VT">Vermont</option>
				<option <?php if ($state == "VA") echo "selected"; ?> value="VA">Virginia</option>
				<option <?php if ($state == "WA") echo "selected"; ?> value="WA">Washington</option>
				<option <?php if ($state == "WV") echo "selected"; ?> value="WV">West Virginia</option>
				<option <?php if ($state == "WI") echo "selected"; ?> value="WI">Wisconsin</option>
				<option <?php if ($state == "WY") echo "selected"; ?> value="WY">Wyoming</option>
			</select>
			<span class="error"><i><?php echo $state_err; ?></i></span><br><br>

			<label for="zip">Zip Code: *</label><br>
			<input type="text" id="zip" name="zip" placeholder="Zip code..." value="<?php echo $zip; ?>">
			<span class="error"><i><?php echo $zip_err; ?></i></span><br><br>

			<label for="phone">Contact Phone Number:</label><br>
			<input type="text" id="phone" name="phone" placeholder="Your phone number..." value="<?php echo $phone; ?>">
			<span class="error"><i><?php echo $phone_err; ?></i></span><br><br>

			<label for="email">Email Address: *</label><br>
			<input type="text" id="email" name="email" placeholder="Your email address..." value="<?php echo $email; ?>">
			<span class="error"><i><?php echo $email_err; ?></i></span><br><br>

			<label for="username">Username: *</label><br>
			<input type="text" id="username" name="username" placeholder="Username..." value="<?php echo $username; ?>">
			Username must be 5-12 characters and not include special characters<br>
			<span class="error"><i><?php echo $username_err; ?></i></span><br><br>

			<label for="password">Password: *</label><br>
			<input type="password" name="password" placeholder="Password..." value="<?php echo $password; ?>">
			Password must be 8-12 characters and include:<br>
			An uppercase letter<br>
			A lowercase letter<br>
			A number<br>
			A special character<br>
			<span class="error"><i><?php echo $password_err; ?></i></span><br>

			<label for="confirm">Confirm password: *</label><br>
			<input type="password" name="confirm" placeholder="Password..." value="<?php echo $confirm; ?>">
			<span class="error"><i><?php echo $confirm_err; ?></i></span><br><br>

			<div class="g-recaptcha" data-sitekey="6LdXtOUUAAAAAMS-KfqG7PceyB4AQFQKmvOQCGgl"></div><br>
			<span class="error"><i><?php echo $captcha_err; ?></i></span><br><br>

			<input type="submit" value="Submit">

			<span class="error"><i><?php echo $status_err; ?></i></span>
		</form>
		</div>
	</div>
</body>
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</html>
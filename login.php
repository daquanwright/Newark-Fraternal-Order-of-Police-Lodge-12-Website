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
	<meta name="google-signin-client_id" content="768195962441-vhj7dm86pt0elr7tvh524n6bnplv9dt4.apps.googleusercontent.com">
	<title>Newark FOP Login</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="homestyle.css">
	<!-- Bootstrap and CSS-->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- Google Platform Library -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1480502115456275',
      cookie     : true,
      xfbml      : true,
      version    : 'v7.0'
    });
      
    FB.AppEvents.logPageView();       
  };
  </script>
</head>

<body class="text-center">

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=1480502115456275&autoLogAppEvents=1" nonce="ZeXL1Nvi"></script>

	<div class="container mt-3">
		<div class="col-sm-12 col-md-12">

			<p class="h3 text-center">Member Login</p>
			<?php
			$username = $password = $session = $wrong = $status_err = "";

			require once('g-signin.php');

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$username = test_input($_POST["username"]);
				$password = $_POST["password"];
				$pass = md5($password);

				include('databaselogin.php');

				$conn = mysqli_connect($servername, $db_user, $db_pass, $database);

				if (!$conn) {
					die("Connection failed" . mysqli_connect_error());
				}

				$query = "SELECT * FROM logins WHERE username = '$username'";

				$data = mysqli_query($conn, $query);

				// require_once "g-login.php";
				// $loginURL = $gClient->createAuthUrl();

				if (!$data) {
					$status_err = "Failed to connect";
				} else {
					$rows = mysqli_fetch_assoc($data);

					if ($rows >= 1) {
						if ($pass == $rows['password']) {
							$session = $_SESSION["user_id"] = session_id();

							$update_query = "UPDATE logins SET session = '$session' WHERE username = '$username'";

							$data2 = mysqli_query($conn, $update_query);

							if (!$data2) {
								$status_err = "Failed to connect";
							} else {
								if ($rows['officer'] == 1) {
									header("Location: police.php");
								} else {
									header("Location: memberpage.php");
								}
							}
						} else {
							$wrong = "Incorrect username or password";
						}
					}
				}

				mysqli_close($conn);
			}

			function test_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}


			?>
			<div class="d-flex justify-content-center">
					<div class="col-md-4">
						<div class="login-form">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<input type="text" id="username" name="username" placeholder="Username" class="form-control">
								<input type="password" id="password" name="password" placeholder="Password" class="form-control"><br>
								<input type="submit" value="Login" class="btn btn-md btn-primary btm-block mt-2 mb-3">
								<span class="error"><i><?php echo $wrong; ?></i></span>
								<br>
								<button onclick="window.location = '<?php echo $login_url;?>'" type="button" class="btn btn-danger">Login with Google</button>
								<a href="signup.php" class="sign-up">SIGN UP!</a>
								<br>
								<a href="forgot.php" class="no-access">FORGOT USERNAME OR PASSWORD?</a>
							</form>
						</div>
					</div>

			</div>
			</div>
	</div>

</body>
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</html>
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
	<body>
		<div class="banner">
			<img class="banner-image" src="fopbanner.jpg">
		</div>

		<h1>CONTACT US</h1>

		<p><b>FOP Lodge 12</b><br>51 Rector St<br>Newark, NJ 07102</p>
		<p><b>Phone:</b> 973-642-0390</p>

		<!-- <div id="map"></div>
		<script>
			function initMap() {
				var address = {lat: 40.741635, lng: -74.166544};
				var map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: address});
				var marker = new google.maps.Marker({position: address, map: map});
			}
		</script>
		<script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
	    </script> -->
	    <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.926765990142!2d-74.16873268428695!3d40.74163694373815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2547f5e2e284d%3A0xf3e9e74e79d87738!2s51%20Rector%20St%2C%20Newark%2C%20NJ%2007102!5e0!3m2!1sen!2sus!4v1583198929951!5m2!1sen!2sus" width="600" height="450" style="float:middle" frameborder="0" style="border:0;" allowfullscreen=""></iframe></p>

	    <p><b>Email Contact Form</b></p>

	    <?php 
			$name = $phone = $email = $subject = $message = $captcha = "";
			$nameErr = $phoneErr = $emailErr = $subjectErr = $messageErr = $captchaErr = $statusErr = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  if (empty($_POST["name"])) {
			    $nameErr = "Name is required";
			  } else {
			    $name = test_input($_POST["name"]);
			    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				  $nameErr = "Only letters and white space allowed";
				}
			  }

			  if (empty($_POST["phone"])) {
			    $phone = "";
			  } else {
			    $phone = test_input($_POST["phone"]);
			    if(!is_numeric($phone)) {
			    	$phoneErr = "Only numbers allowed";
			    }
			    if(strlen($phone) != 10) {
			    	$phoneErr = "The number entered was not 10 digits long";
			    }
			  }

			  if (empty($_POST["email"])) {
			    $emailErr = "Email is required";
			  } else {
			    $email = test_input($_POST["email"]);
			    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  $emailErr = "Invalid email format";
				}
			  }

			  if (empty($_POST["subject"])) {
			    $subjectErr = "Subject is required";
			  } else {
			    $subject = test_input($_POST["subject"]);
			  }

			  if (empty($_POST["message"])) {
			    $messageErr = "Message is required";
			  } else {
			    $message = test_input($_POST["message"]);
			  }

			  if(isset($_POST['g-recaptcha-response']))
			  {
			      $captcha = $_POST['g-recaptcha-response'];
			  }
			  if(!$captcha)
			  {
			      $captchaErr = "Please check the captcha";
			  }

			  if ($nameErr == "" && $phoneErr == "" && $emailErr == "" && $subjectErr == "" && $messageErr == "" && $captchaErr == "") {
			  	$header = "From: $email" . "\r\n";
			  	$msg = "Name: $name\n\nPhone: $phone\n\n$message";
			  	if(mail("waw68qveviqa", $subject, $msg, $header)) {
			  		echo '<script language="javascript">';
					echo 'alert("Email successfully sent");';
					echo 'window.location="home.php"';
					echo '</script>';
			  	} else {
			  		$statusErr = "Error sending email";
			  	}
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
			  <label for="name">Full Name: *</label><br>
			  <input type="text" id="name" name="name" placeholder="Your full name..." value="<?php echo $name;?>">
			  <span class="error"><i><?php echo $nameErr;?></i></span><br><br>

			  <label for="phone">Contact Phone Number:</label><br>
			  <input type="text" id="phone" name="phone" placeholder="Your phone number..." value="<?php echo $phone;?>">
			  <span class="error"><i><?php echo $phoneErr;?></i></span><br><br>

			  <label for="email">Contact Email Address: *</label><br>
			  <input type="text" id="email" name="email" placeholder="Your email address..." value="<?php echo $email;?>">
			  <span class="error"><i><?php echo $emailErr;?></i></span><br><br>

			  <label for="subject">Email Subject: *</label><br>
			  <input type="text" id="subject" name="subject" placeholder="Your email subject..." value="<?php echo $subject;?>">
			  <span class="error"><i><?php echo $subjectErr;?></i></span><br><br>

			  <label for="message">Email Message: *</label><br>
			  <textarea id="message" name="message" placeholder="Your message..." style="height:200px"><?php echo $message;?></textarea>
			  <span class="error"><i><?php echo $messageErr;?></i></span><br><br>

			  <div class="g-recaptcha" data-sitekey="6LdXtOUUAAAAAMS-KfqG7PceyB4AQFQKmvOQCGgl"></div><br>
			  <span class="error"><i><?php echo $captchaErr;?></i></span><br><br>

			  <input type="submit" value="Submit Email">
			  <center>* Required Fields</center>
			  <span class="error"><i><?php echo $statusErr;?></i></span>
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
</html>
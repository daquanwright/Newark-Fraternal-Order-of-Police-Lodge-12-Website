<?php
	if(!defined('MyConst')) {
	   die('Direct access not permitted');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
	<!-- Header -->
	<div class="container">

		<div class="row">
			<div class="col-md-1 mr-3">
				<img src="images/logo.png" style="width:90px;" alt="logo">
			</div>
			<div class="col-md-6 my-auto">
				<h5 class="">Newark Fraternity Order of Police</h5>
			</div>

			<div class="col-md-4">
				<!-- <div class="input-group" style="width: 50%;">
								<input class="form-control py-2 border-right-0 border" type="search" value="search" id="example-search-input">
								<span class="input-group-append">
									<div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
								</span>
							</div> -->

			</div>
		</div>

	</div>
	<div class="container">
		<nav class="navbar navbar-expand-md navbar-light bg-light">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="home.php">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="aboutus.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							About Us
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Meet the Team</a>
							<a class="dropdown-item" href="#">Gallery</a>
						</div>
					<li class="nav-item">
						<a class="nav-link" href="events.php">Events</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="donate.php">Donate</a>
					</li>

				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Police Name
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown2">
							<a class="dropdown-item" href="memberpage.php" style="">Member Page</a>
							<a class="dropdown-item" href="reset.php" style="padding-left: 24px;">Change Password</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="logout.php" style="">Log Out</a>
						</div>
					</li>
				</ul>
			</div>
			</nav>
	</div>
</body>
</html>
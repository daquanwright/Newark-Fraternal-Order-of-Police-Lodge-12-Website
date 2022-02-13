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
	<!-- Alerts and Carousel -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card alert-custom">
					<div class="row no-gutters">
						<div class="col-sm-12 col-md-3 p-3 title-alert text-right">
							<h4 class="card-title-left mr-2 mb-0"><span class="alert-white">Information</span> on <br>
								Novel Coronavirus<br>
								<span class="alert-date smaller">
									<script id="twitter-wjs" src="https://platform.twitter.com/widgets.js"></script>
									<script language="JavaScript" type="text/javascript">
										var months = new Array(12);
										months[0] = "January";
										months[1] = "February";
										months[2] = "March";
										months[3] = "April";
										months[4] = "May";
										months[5] = "June";
										months[6] = "July";
										months[7] = "August";
										months[8] = "September";
										months[9] = "October";
										months[10] = "November";
										months[11] = "December";

										var current_date = new Date();
										month_value = current_date.getMonth();
										day_value = current_date.getDate();
										year_value = current_date.getFullYear();

										document.write(months[month_value] + " " +
											day_value + ", " + year_value);
									</script>
								</span></h4>
						</div>
						<div class="col-sm-12 col-md-9">
							<div class="card-block py-3 ">
								<p class="alert-card-text py-0 pl-3 m-0"> Have general questions about COVID-19?<br>
									<small> The NJ Poison Control Center and 211 have partnered with the State to provide information to the public on COVID-19:</small><br>
									Call: <a href="tel:2-1-1"><span class="alert-red">2-1-1</span></a><br>
									Call (24/7):<a href="tel:800-962-1253"><span class="alert-red"> 1-800-962-1253</span></a><br>
									Text: <span class="alert-red">NJCOVID</span> to <span class="alert-red">898-211</span>
									<!--Text: your <span class="alert-red">zip code to 898-211</span> for live text assistance--><br>
									Visit <a href="https://covid19.nj.gov/" target="_blank">https://covid19.nj.gov/</a> or <a href="https://www.nj.gov/health/cd/topics/ncov.shtml" target="_blank">nj.gov/health</a> for additional information </p>
							</div>
						</div>
					</div>
				</div>
				<div class="carousel slide" id="carousel-814050">
					<ol class="carousel-indicators">
						<li data-slide-to="0" data-target="#carousel-814050" class="active">
						</li>
						<li data-slide-to="1" data-target="#carousel-814050">
						</li>
						<li data-slide-to="2" data-target="#carousel-814050">
						</li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block w-100" alt="Carousel Bootstrap First" src="https://www.layoutit.com/img/sports-q-c-1600-500-1.jpg">
							<div class="carousel-caption">
								<h4>
									Become A Member
								</h4>
								<p>
									Sign up today to join and become a member of the family!
								</p>
								<button type="button" class="btn btn-primary"><a href="login.php" class="btn btn-primary">Membership</a></button>
							</div>
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" alt="Carousel Bootstrap Second" src="https://www.layoutit.com/img/sports-q-c-1600-500-2.jpg">
							<div class="carousel-caption">
								<h4>
                                    Donate To The Cause
                                </h4>
                                <p>
                                	Whether it be public service, checking bomb threats, or keeping public spaces safe....a little financial boost helps along the way. Donating is always appreciated!
                                </p>
                                <button type="button" class="btn btn-danger"><a href="donate.php" class="btn btn-danger">Donate</a></button>
							</div>
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" alt="Carousel Bootstrap Third" src="https://www.layoutit.com/img/sports-q-c-1600-500-3.jpg">
							<div class="carousel-caption">
								<h4>
                                    Newark Fraternity Order of Police Events
                                </h4>
                                <p>
                                    Be it events hard working public servants will join in on or events being guided by police, why not relax and have some fun?!
                                </p>
                                <button type="button" class="btn btn-warning"><a href="events.php" class="btn btn-warning">Events</a></button>
							</div>
						</div>
					</div> <a class="carousel-control-prev" href="#carousel-814050" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-814050" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
				</div>
			</div>
		</div>


		<!-- Important Links Box -->
		<div class="container">
			<div class="row">
				<div class="col-md-4 boxes-index">
					<h2>Important Links</h2>
					<div class="panel-body">
						<a href="http://npd.newarkpublicsafety.org/index.php" target="_blank">Newark Police Department</a>
						<hr>
						<a href="https://www.newarknj.gov/" target="_blank">City of Newark</a>
						<hr>
						<a href="https://www.nj.gov/treasury/pensions/pension-active-pers.shtml">New Jersey PERS</a>
						<hr>
						<a href="https://www.dol.gov/general/topic/labor-relations">US Dept. Of Labor</a>
						<hr>
						<a href="https://nleomf.org/">National Law Enforcement Officers Memorial</a>
						<hr>
					</div>
				</div>

				<!-- Action Center Box -->
				<div class="col-md-4 boxes-index">
					<h2>
						Action Center
					</h2>
					<img src="images/njfop1.jpg">
					<br>
					<a href="https://njfop.com/" target="_blank">New Jersey Fraternal Order of Police</a>
					<!-- 	<a href="New Jersey Fraternal Order of Police"><img class="tomimage" src="tomcop.jpg"></a> -->
					<!-- 	<p>We are the Newark Fratern
					al Order of Police Lodge #12</p> -->
					<img src="images/foplogo.jpg">
					<br>
					<a href="https://www.fop.net/" target="_blank">National Fraternal Order of Police</a>
				</div>

				<!-- Announcements Box -->
				<div class="col-md-4 boxes-index">
					<h2>
						NJ FOP Announcements
					</h2>
						<div class="justify-content-center">
						<!-- start sw-rss-feed code -->
						<script type="text/javascript">
							rssfeed_url = new Array();
							rssfeed_url[0] = "https://njfop.org/news/";
							rssfeed_frame_width = "270";
							rssfeed_frame_height = "400";
							rssfeed_scroll = "off";
							rssfeed_scroll_step = "6";
							rssfeed_scroll_bar = "on";
							rssfeed_target = "_blank";
							rssfeed_font_size = "12";
							rssfeed_font_face = "";
							rssfeed_border = "on";
							rssfeed_css_url = "";
							rssfeed_title = "off";
							rssfeed_title_name = "";
							rssfeed_title_bgcolor = "#3366ff";
							rssfeed_title_color = "#fff";
							rssfeed_title_bgimage = "";
							rssfeed_footer = "off";
							rssfeed_footer_name = "rss feed";
							rssfeed_footer_bgcolor = "#fff";
							rssfeed_footer_color = "#333";
							rssfeed_footer_bgimage = "";
							rssfeed_item_title_length = "50";
							rssfeed_item_title_color = "#666";
							rssfeed_item_bgcolor = "#fff";
							rssfeed_item_bgimage = "";
							rssfeed_item_border_bottom = "on";
							rssfeed_item_source_icon = "off";
							rssfeed_item_date = "off";
							rssfeed_item_description = "on";
							rssfeed_item_description_length = "120";
							rssfeed_item_description_color = "#666";
							rssfeed_item_description_link_color = "#333";
							rssfeed_item_description_tag = "off";
							rssfeed_no_items = "0";
							rssfeed_cache = "3bc9f3bd71410e1651cb9b07108836a8";
						</script>
						</div>
						<script type="text/javascript" src="https://feed.surfing-waves.com/js/rss-feed.js"></script>
						<!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. -->
						<div style="color:#ccc;font-size:10px; text-align:right; width:275px;">powered by <a href="https://surfing-waves.com" rel="noopener" target="_blank" style="color:#ccc;">Surfing Waves</a>
							<!-- end sw-rss-feed code -->
						</div>
					</p>
				</div>
			</div>
		</div>



		<!-- Recent News -->
		<div class="row">
			<div class="col-md-12">
				<p>
					<script src="https://cdn.commoninja.com/sdk/latest/commonninja.js" defer></script>
					<div class="commonninja_component" comp-type="feed" comp-id="6e1ee27b-032f-4da4-bfba-7a0a19e2f86a"></div>
				</p>
			</div>
		</div>

		<!-- Footer -->
		<div class="footer">
			<div class="footer-image">
			</div>
			<div class="footer-bottom">
				Copyright &copy; 2020, All Rights Reserved.<br> Rutgers Newark Computer Science
			</div>
		</div>
	</div>
	<!-- /Footer -->


</body>
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>

</html>

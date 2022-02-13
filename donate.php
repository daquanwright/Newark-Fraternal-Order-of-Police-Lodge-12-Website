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
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Newark FOP Donate</title>

  <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>

<body>
  <style>
  </style>


  <!-- you can also add something like style="min-height: 70vh;" to the div above -->
  <div class="container">
    <div class="jumbotron jumbotron-billboard">
      <div class="img"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2>Donate</h2>
            <p>
              Your donations to our lodge will enable
              us to continue to serve the officers
              and the community in which we serve.

              Any amount is greatly appreciated.
              The Newark Fraternal Order of Police
              and its members thank you
              for your continued support.
            </p>
          </div>
          <div class="col-lg-6">
            <div class="container center_div">
              <form action="https://www.paypal.com/cgi-bin/webscr" style="" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick" />
                <input type="hidden" name="hosted_button_id" value="B3R7ELF3XXBSC" />
                <input type="image" style="padding-top: 40px;padding-bottom: 40px;" src="images/paypaldonationbutton.png" class="centered-image m-auto d-block img-fluid" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="container">
    <div class="container-fluid" style="padding-top: 50px;">
      <div class="row">
        <div class="col-md-6">
          <h3>
            DONATE
          </h3>
          <p class="lead">
            Your donations to our lodge will enable
            us to continue to serve the officers
            and the community in which we serve.

            Any amount is greatly appreciated.
            The Newark Fraternal Order of Police
            and its members thank you
            for your continued support. </p>
            <img class="img-fluid" src="images/donatepic.jpg" alt="donatepic">
        </div>
        <div class="col-md-6 d-flex justify-contents-center">
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="B3R7ELF3XXBSC" />
            <input type="image" style="width:250px;" src="images/paypaldonationbutton.png" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
          </form>
        </div>
      </div>
    </div>
  </div> -->


</body>
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</html>
<?php
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
        header("Location: police.php");
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
<html>

<head>
  <title>Newark FOP Member Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<section class="pricing py-5">
  <div class="container">
    <div class="row">
      <!-- Free Tier -->
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
            <h6 class="card-price text-center">$0<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Single User</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>5GB Storage</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
            <h6 class="card-price text-center">$0<span class="period">/month</span></h6>
            <hr>
            <ul class="fa-ul">
              <input type="file button" id="fop_form" name="fop_form" class="btn"><br><br>              
              <li><span class="fa-li"><i class="fas fa-check"></i></span>5GB Storage</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- <div class="box">
    <div class="box1">
      <h2> Initial Membership Fee</h2>
      <p2> $125- Application</p2><br><br>
      <p3> $10- Shipping and Handling</p3><br><br>
      <p4> Total = $135</p4>
      <div id="paypal-button-container"></div>

    </div>
    <div class="box2">
      <h2> Initial Membership Fee</h2>
      <h4> Shipping not included must pick up at FOP</h4>
      <p2> $125- Application</p2><br><br>
      <p2> $0- Shipping and Handling</p2><br><br>
      <p2> Total = $125</p2>
    </div>
    <div class="box3">
      <h2> Membership Renewal Fee</h2>
      <p2> $37- Renewal </p2><br><br>
      <p2> Total = $37</p2>
    </div>
  </div>
  <div class="button">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="FXJ48TQS6HNPG">
      <table>
        <tr>
          <td><input type="hidden" name="on0" value="Membership">Membership</td>
        </tr>
        <tr>
          <td><select name="os0">
              <option value="Initial Membership with Shipping">Initial Membership with Shipping $135.00 USD</option>
              <option value="Initial Membership- Shipping Not Included">Initial Membership- Shipping Not Included $125.00 USD</option>
              <option value="Membership Renewal">Membership Renewal $37.00 USD</option>
            </select> </td>
        </tr>
      </table>
      <input type="hidden" name="currency_code" value="USD">
      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
  </div>
  <br><br><br>
  <div class="section">
    <div class="documents">
      <h3>Please Open and Fill Out Form</h3>
      <a href="NewarkFOP1.pdf">FOP Front</a><br>
      <a href="NewarkFOP2.pdf">FOP Back</a>
    </div>
    <div class="upload">
      <h3>Please Upload the Form, Driver's License, and Registration</h3>
      <form method="post" action="upload.php" enctype="multipart/form-data">
        FOP Form
        <input type="file" id="fop_form" name="fop_form"><br><br>
        License
        <input type="file" id="license" name="license"><br><br>
        Registration
        <input type="file" id="registration" name="registration"><br><br>
        <input type="submit">
      </form>
    </div>
  </div> -->
</body>
<div class="footer">
  <div class="footer-image">
    <img class="seniorprojectlogo" src="seniorprojectlogo.png">
  </div>
  <div class="footer-bottom">
    Copyright &copy; 2020, All Rights Reserved.<br> Rutgers Newark Computer Science
  </div>
</div>

</html>
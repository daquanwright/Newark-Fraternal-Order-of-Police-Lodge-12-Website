<?php
	session_start();
  
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
        $username = $rows['username'];

        $update_query = "UPDATE logins SET session = '' WHERE username = '$username'";

        $data2 = mysqli_query($conn, $update_query);

        mysqli_close($conn);

        if(!$data2) {
          $status_err = "Failed to connect";
        }

        session_destroy();

        header("Location: login.php");
      } else {
        header("Location: login.php");
      }
    }
  } else {
    header("Location: login.php");
  }
?>
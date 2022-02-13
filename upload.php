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
				$lastname = $rows['last_name'];
				$firstname = $rows['first_name'];

				if(file_exists(basename($_FILES["fop_form"]["name"]))) {
					$msg = 'FOP FORM:\n';
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["fop_form"]["name"]);
					$file_name = $target_dir . $lastname . "_" . $firstname . "_fop_form";
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Check if image file is a actual image or fake image
				    $check = getimagesize($_FILES["fop_form"]["tmp_name"]);
				    $finfo = finfo_open(FILEINFO_MIME_TYPE);
				    finfo_file($finfo, basename($_FILES["fop_form"]["name"]));
				    $file_type = finfo_file($finfo, basename($_FILES["fop_form"]["name"]));
				    finfo_close($finfo);
				    if($check !== false) {
				        $uploadOk = 1;
				    } else if ($file_type == "application/pdf") {
				    	$uploadOk = 1;
				    } else {
				        $msg .= 'File is not an image or pdf.\n';
				        $uploadOk = 0;
				    }
					// Check file size
					if ($_FILES["fop_form"]["size"] > 500000) {
						$msg .= 'Sorry, your file is too large.\n';
					    $uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
						$msg .= 'Sorry, only JPG, JPEG, PNG, & PDF files are allowed.\n';
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$msg .= 'Sorry, your file was not uploaded.\n';
					// if everything is ok, try to upload file
					} else {
					    if (move_uploaded_file($_FILES["fop_form"]["tmp_name"], $file_name)) {
					    	$msg .= 'File has been uploaded.\n';

					        $update_query = "UPDATE logins SET fop_form = '$file_name' WHERE username = '$username'";
							$data = mysqli_query($conn, $update_query);

							if(!$data) {
								$status_err = "Failed to connect";
							}
					    } else {
					    	$msg .= 'Sorry, there was an error uploading your file.\n';
					    }
					}
					
					echo '<script language="javascript">';
			        echo 'alert("'.$msg.'");';
			        echo '</script>';
				}

				if(file_exists(basename($_FILES["license"]["name"]))) {
					$msg = 'LICENSE:\n';
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["license"]["name"]);
					$file_name = $target_dir . $lastname . "_" . $firstname . "_license";
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Check if image file is a actual image or fake image
				    $check = getimagesize($_FILES["license"]["tmp_name"]);
				    $finfo = finfo_open(FILEINFO_MIME_TYPE);
				    finfo_file($finfo, basename($_FILES["license"]["name"]));
				    $file_type = finfo_file($finfo, basename($_FILES["license"]["name"]));
				    finfo_close($finfo);
				    if($check !== false) {
				        $uploadOk = 1;
				    } else if ($file_type == "application/pdf") {
				    	$uploadOk = 1;
				    } else {
				        $msg .= 'File is not an image or pdf.\n';
				        $uploadOk = 0;
				    }
					// Check file size
					if ($_FILES["license"]["size"] > 500000) {
					    $msg .= 'Sorry, your file is too large.\n';
					    $uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
						$msg .= 'Sorry, only JPG, JPEG, PNG, & PDF files are allowed.\n';
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					    $msg .= 'Sorry, your file was not uploaded.\n';
					// if everything is ok, try to upload file
					} else {
					    if (move_uploaded_file($_FILES["license"]["tmp_name"], $file_name)) {
					        $msg .= 'File has been uploaded.\n';

					        $update_query = "UPDATE logins SET license = '$file_name' WHERE username = '$username'";
							$data = mysqli_query($conn, $update_query);

							if(!$data) {
								$status_err = "Failed to connect";
							}
					    } else {
					        $msg .= 'Sorry, there was an error uploading your file.\n';
					    }
					}

					echo '<script language="javascript">';
			        echo 'alert("'.$msg.'");';
			        echo '</script>';
				}

				if(file_exists(basename($_FILES["registration"]["name"]))) {
					$msg = 'REGISTRATION:\n';
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["registration"]["name"]);
					$file_name = $target_dir . $lastname . "_" . $firstname . "_registration";
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Check if image file is a actual image or fake image
				    $check = getimagesize($_FILES["registration"]["tmp_name"]);
				    $finfo = finfo_open(FILEINFO_MIME_TYPE);
				    finfo_file($finfo, basename($_FILES["registration"]["name"]));
				    $file_type = finfo_file($finfo, basename($_FILES["registration"]["name"]));
				    finfo_close($finfo);
				    if($check !== false) {
				        $uploadOk = 1;
				    } else if ($file_type == "application/pdf") {
				    	$uploadOk = 1;
				    } else {
				        $msg .= 'File is not an image or pdf.\n';
				        $uploadOk = 0;
				    }
					// Check file size
					if ($_FILES["registration"]["size"] > 500000) {
					    $msg .= 'Sorry, your file is too large.\n';
					    $uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
						$msg .= 'Sorry, only JPG, JPEG, PNG, & PDF files are allowed.\n';
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					    $msg .= 'Sorry, your file was not uploaded.\n';
					// if everything is ok, try to upload file
					} else {
					    if (move_uploaded_file($_FILES["registration"]["tmp_name"], $file_name)) {
					        $msg .= 'File has been uploaded.\n';

					        $update_query = "UPDATE logins SET registration = '$file_name' WHERE username = '$username'";
							$data = mysqli_query($conn, $update_query);

							if(!$data) {
								$status_err = "Failed to connect";
							}
					    } else {
					        $msg .= 'Sorry, there was an error uploading your file.\n';
					    }
					}

					echo '<script language="javascript">';
			        echo 'alert("'.$msg.'");';
			        echo '</script>';
				}

				echo '<script language="javascript">';
				echo 'window.location="memberpage.php"';
				echo '</script>';
			} else {
				header("Location: login.php");
			}
		}
	} else {
		header("Location: login.php");
	}
?>
<?php
	include_Once('./config.php');

	session_start();
	$logtype = $_SESSION["type"];
  	$nics = $_SESSION["nic"];
  	$usertype = $_SESSION["usertype"];

?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA</title>

	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/superfish.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">	
	<link rel="stylesheet" href="css/style.css">

	<script src="js/modernizr-2.6.2.min.js"></script>	
	

	</head>
	
	
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="donor/DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<?php if($usertype == "authorizer") {?> 
								
								<li class="active"><a href="authorizer/Authorizer_UI.php">Dashboard</a></li><li>
								<a href="#" class="fh5co-sub-ddown">Request</a>
								<ul class="fh5co-sub-menu">
									<li><a href="AddRequestAdminAuthorizer.php">Create request</a></li>
									<li><a href="ViewReuest.php">View Request</a></li>
								</ul>
								</li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="logout.php">Logout</a></li>

							
							<?php }else  {?> 
								
								<li class="active"><a href="requester/Requester_UI.php">Dashboard</a></li>
								<li>
									<a href="#" class="fh5co-sub-ddown">Request</a>
									<ul class="fh5co-sub-menu">
										<li><a href="requester/requestForm.php">Create request</a></li>
										<li><a href="ViewReuest.php">View Request</a></li>
										
									</ul>
								</li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li><a href="logout.php">Logout</a></li>

							<?php }  ?>

						</ul>
					</nav>
				</div>
			</div>
		</header>


		<!-- end:header-top -->
		
  		<div class="fh5co-section-gray"><br>
		<?php

			if ($usertype == "authorizer") {

				$sql = "SELECT tblrequestnotification.Notification_ID, tblrequestnotification.Auth_Status, tblrequest.Request_ID, tblrequest.fullname, tblrequest.menreq, tblrequest.category FROM tblrequest INNER JOIN tblrequestnotification ON tblrequestnotification.Req_ID = tblrequest.Request_ID";
				if ($result = mysqli_query($con,$sql)) {
					if(mysqli_num_rows($result)>0){

						echo '<table class="table"><caption><h3 align="center"><b>Notifications</b></h3></caption><thead>
						<tr><th scope="col"></th>
							<th scope="col">Requester Name</th>
			  				<th scope="col">Request Title</th>
			  				<th scope="col">Category</th>
			  				<th scope="col"></th>
						</tr></thead><tbody>';

						while ($row = $result->fetch_assoc()) {

							$auth_status = $row["Auth_Status"];
							$not_id = $row["Notification_ID"];
							$fname = $row["fullname"];
							$menreq = $row["menreq"]; 
							$category = $row["category"];
		
							echo '<form action="" method="POST">
							<tr class="danger">
							 <td></td>  
							<td>'.$fname.'</td>';

					        if($auth_status == '1'){
					        	echo '<td><b><a href="AuthorizerApproveRequest.php" >'.$menreq.'</a></b></td>
					        		  <td>'.$category.'</a></td>
					        		  <td><button type="submit" class="btn btn-warning" name="auth_mark_read">Mark as Read</button>
					        		  <input type="hidden" name="hrid" value="'.$not_id.'"</td>';
					        } else{
					        	echo '<td>'.$menreq.'</td>
					        		  <td>'.$category.'</a></td>
					        		  <td></td> ';
					        }

				  			echo '</form></tr>';
			  			}	
			  		}else 
					{
						echo "<br><h3 align='center'>No Notifications</h3>";
						echo "</br></br>";
					}
	  			}       
	  			echo '</tbody></table>';

			}else if($usertype == "requester"){

				$sql = "SELECT tblrequestnotification.Notification_ID, tblrequestnotification.Req_Status, tblrequest.Request_ID, tblrequest.menreq, tblrequest.category, tblrequest.exreq, tblrequest.Status  FROM tblrequest INNER JOIN tblrequestnotification ON tblrequestnotification.Req_ID = tblrequest.Request_ID WHERE nic = $nics";
				if ($result = mysqli_query($con,$sql)) {
					if(mysqli_num_rows($result)>0){

						echo '<table class="table"><caption><h3 align="center"><b>Notifications</b></h3></caption><thead>
						<tr><th scope="col"></th>
							<th scope="col">Status</th>
							<th scope="col">Request Title</th>
			  				<th scope="col">Description</th>
			  				<th scope="col">Category</th>
			  				<th scope="col"></th>
						</tr></thead><tbody>';
						
						while ($row = $result->fetch_assoc()) {
							$not_status = $row["Status"];
							$req_status = $row["Req_Status"];
							$not_id = $row["Notification_ID"];
							$menreq = $row["menreq"]; 
							$exreq = $row["exreq"];
							$category = $row["category"];
		
							echo '<form action="" method="POST">
								<tr class="danger">
								<td></td>';

					        if($req_status == '1'){
					        	echo '<td>'.$not_status.'</a></td>
					        		  <td><b><a href="ViewReuest.php" >'.$menreq.'</a></b></td>
					        		  <td>'.$exreq.'</a></td>
					        		  <td>'.$category.'</a></td>
					        		  <td><button type="submit" class="btn btn-warning" name="req_mark_read">Mark as Read</button>
					        		  <input type="hidden" name="hrid" value="'.$not_id.'"</td>';
					        } else if($req_status == '0'){
					        	echo '<td>'.$not_status.'</a></td>
					        	      <td>'.$menreq.'</td>
					        		  <td>'.$exreq.'</a></td>
					        		  <td>'.$category.'</a></td>
					        		  <td></td> ';
					        }
					        echo '</form></tr>';
			  			}
			  		}
			  		else 
					{
						echo "<br><h3 align='center'>No Notifications</h3>";
						echo "</br></br>";
					}	
	  			}       
	  			echo '</tbody></table>';
			}

		?>

		<?php
			if(isset($_POST['auth_mark_read'])){
				$key = $_POST['hrid'];

				$qupdate = mysqli_query($con,"UPDATE `tblrequestnotification` SET Auth_Status = '0' WHERE Notification_ID = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}

			if(isset($_POST['req_mark_read'])){
				$key = $_POST['hrid'];

				$qupdate = mysqli_query($con,"UPDATE `tblrequestnotification` SET Req_Status = '0' WHERE Notification_ID = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
			
		?>

		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br></br>

	</div>
		<footer>
			<div id="footer2">
				<div class="container">
					<div class="row row-bottom-padded-md">
						
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>


	</div>


	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

<?php
	include_Once('./config.php');

	session_start();
	$req_nic = $_SESSION['nic'];
	$usertype = $_SESSION['usertype'];

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
							
							<?php if($usertype == "admin") {?> 
								
								<li class="active"><a href="admin/Admin_UI.php">Dashboard</a></li>
								<li><a href="admin/AdminManageUser.php">Manage Users</a></li>
								<li><a href="GenerateReports.php">Generate Reports</a></li>
								<li><a href="logout.php">Logout</a></li>
							
							<?php }else if($usertype == "authorizer") {?> 
								
								<li class="active"><a href="authorizer/Authorizer_UI.php">Dashboard</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li><a href="logout.php">Logout</a></li>

							<?php } else {?> 
								
								<li class="active"><a href="requester/Requester_UI.php">Dashboard</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li><a href="logout.php">Logout</a></li>

							<?php }  ?>

						</ul>
					</nav>
				</div>
			</div>
		</header>


	<div class="fh5co-section-gray"><br>
	<?php

		if ($usertype == "requester") {
			loadData("SELECT * FROM tblrequest WHERE nic = '$req_nic' ");
		}
		else {
			loadData("SELECT * FROM tblrequest WHERE status= 'Approved'");
		}

		function loadData($query){

			include ('./config.php');

			$sql = $query;
			if ($result = mysqli_query($con,$sql)) {
				if(mysqli_num_rows($result)>0){
					echo '<div class="fh5co-hero">
						<table class="table"><caption><h3 align="center"><b>View Requests</b></h3></caption>
						  <thead>
							<tr>
							  <th></th>
							  <th scope="col" width="270px">REQUIREMENT</th>
							  <th scope="col" width="400px">EXPLAIN REQUIREMENT</th>
							  <th scope="col">CATEGORY</th>
							  <th scope="col">DATE</th>
							  <th scope="col">DOCUMENT</th>
							  <th scope="col">STATUS</th>
							  <th scope="col"></th>
							  <th></th>
							</tr></thead><tbody>';
					while ($row = $result->fetch_assoc()) {
						$req_id = $row["Request_ID"];
						$req = $row["menreq"];
						$exreq = $row["exreq"];
						$category = $row["category"];
						$date = $row["lastday"]; 
						$attachment = $row["file"];
						$status = $row["status"];

						echo '<tr class="danger"> 
						<td></td>
				        <td>'.$req.'</td> 
				        <td>'.$exreq.'</td> 
				        <td>'.$category.'</td>
				        <td>'.$date.'</td>
				        <td><a href="upload/'.$attachment.'">'.$attachment.'</a></td>
				        <td>'.$status.'</td>
				        <td><form method="POST" action="#"><button type="submit" class="btn btn-danger" name="delete">Delete</button><input type="hidden" name="hid" value="'.$req_id.'"></form></td>
				        <td></td>
				        
				      </tr>';
					}
				}else 
					{
						echo "<br><h3 align='center'>No Requests</h3>";
						echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
					}
						
			}
			echo '</tbody></table></div>';
		}

		if(isset($_POST['delete'])){
				
			

			$key = $_POST['hid'];
			$qdelete = mysqli_query($con,"DELETE FROM `tblrequest` WHERE Request_ID = '$key'") or die("Action not successful".mysql_error());

			$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequestnotification` WHERE Req_ID = '$key'") or die("Action not successful".mysql_error());

			echo "<meta http-equiv='refresh' content='0'>";
			header("Refresh:0");
			
			//else{
			///	$qupdate = mysqli_query($con,"DELETE FROM `tbldonor` WHERE nic = '$key'") or die("Action not successful".mysql_error());
			//	header("Refresh:0");
			//}
		}
		
		
	?>
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


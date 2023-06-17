<?php
include_Once('../config.php');
?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA</title>

	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/icomoon.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/superfish.css">
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="../css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="../css/cs-select.css">
	<link rel="stylesheet" href="../css/cs-skin-border.css">	
	<link rel="stylesheet" href="../css/style.css">

	<script src="../js/modernizr-2.6.2.min.js"></script>	
	

	</head>
	
	
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="../donor/DonorrequestView.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="Admin_UI.php">Dashboard</a></li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Add User</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../registrationRequester.php">Requester</a></li>
									<li><a href="../registrationDonor.php">Doner</a></li>
									<li><a href="../registrationAuthorizer.php">Authorizer</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Request</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../AddReqestAdminAuthorizer.php">Create request</a></li>
									<li><a href="../ViewReuest.php">View Request</a></li>
								</ul>
							</li>
							<li><a href="../logout.php">Logout</a></li>
							
							
						</ul>
					</nav>
				</div>
			</div>
		</header>


		<!-- end:header-top -->
					
		<div  class="fh5co-section-gray"><br>
		<?php

  			$sql = "SELECT nic,fname,lname,gender,age,email,telephone_mobile,occupation,address_residential,address_official,Status FROM tblauthorizer WHERE Status ='Pending'";
			if ($result = mysqli_query($con,$sql)) {
				if(mysqli_num_rows($result)>0){

					echo '<table class="table"><caption><h3 align="center"><b>Pending Approval</b></h3></caption>
			  					<thead>
								<tr><th scope="col"></th>
					  				<th scope="col">NIC</th>
					  				<th scope="col">First Name</th>
					  				<th scope="col">Last Name</th>
					  				<th scope="col">Gender</th>
					  				<th scope="col">Age</th>
					  				<th scope="col">Email</th>
					  				<th scope="col">Phone</th>
					  				<th scope="col">Occuparion</th>
					  				<th scope="col">Address Residential</th>
					  				<th scope="col">Address Official</th>
					  				<th scope="col">Status</th>
					  				<th scope="col">Action</th>
					  				<th scope="col"></th>
								</tr>
				  			</thead><tbody>;';

					while ($row = $result->fetch_assoc()) {

						$nic = $row["nic"];
						$fname = $row["fname"];
						$lname = $row["lname"];
						$gender = $row["gender"]; 
						$age = $row["age"];
						$email = $row["email"];
						$phone = $row["telephone_mobile"];
						$occupation = $row["occupation"];
						$addressr = $row["address_residential"];
						$addresso = $row["address_official"];
						$status = $row["Status"];
	
						echo '<form action="" method="POST">
						<tr class="danger">
						 <td></td> 
				        <td>'.$nic.'</td> 
				        <td>'.$fname.'</td> 
				        <td>'.$lname.'</td>
				        <td>'.$gender.'</td>
				        <td>'.$age.'</a></td>
				        <td>'.$email.'</a></td>
				        <td>'.$phone.'</td>
				        <td>'.$occupation.'</td>
				        <td>'.$addressr.'</td>
				        <td>'.$addresso.'</td>
				        <td>'.$status.'</td>
				        <td><button type="submit" class="btn btn-warning" name="approve">Approve</button>
				        <input type="hidden" name="hnic" value="'.$nic.'"</td>
			  			<td><button type="submit" class="btn btn-danger" name="reject">Reject</button></td>
			  			</form>
				      </tr>';
		  			}	
				}
				else 
				{
					echo "<br><h3 align='center'>No Authorizers to Approve</h3>";
					echo "</br></br>";
				}
				
  			}       
		  	echo '</tbody></table>';
		?>

		<?php
			if(isset($_POST['approve'])){
				$key = $_POST['hnic'];
			
				$qupdate = mysqli_query($con,"UPDATE `tblauthorizer` SET Status = 'Approved' WHERE nic = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
			elseif(isset($_POST['reject'])){
				$key = $_POST['hnic'];
				$qupdate = mysqli_query($con,"UPDATE `tblauthorizer` SET Status = 'Reject' WHERE nic = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
		?>

		</br></br></br></br></br></br></br></br></br></br></br></br></br>
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

	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.easing.1.3.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.waypoints.min.js"></script>
	<script src="../js/sticky.js"></script>
	<script src="../js/jquery.stellar.min.js"></script>
	<script src="../js/hoverIntent.js"></script>
	<script src="../js/superfish.js"></script>
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<script src="../js/bootstrap-datepicker.min.js"></script>
	<script src="../js/classie.js"></script>
	<script src="../js/selectFx.js"></script>
	<script src="../js/main.js"></script>

	</body>
</html>

<?php
include_Once('../config.php');

session_start();
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
							<li class="active"><a href="Authorizer_UI.php">Dashboard</a></li><li>
								<a href="#" class="fh5co-sub-ddown">Request</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../AddReqestAdminAuthorizer.php">Create request</a></li>
									<li><a href="../ViewReuest.php">View Request</a></li>
								</ul>
							</li>
							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../logout.php">Logout</a></li>
							
							
						</ul>
					</nav>
				</div>
			</div>
		</header>


		<!-- end:header-top -->
					
		<div  class="fh5co-section-gray"><br>
		<?php

  			$sql = "SELECT tblrequestnotification.Notification_ID, tblrequest.Request_ID, tblrequest.nic, tblrequest.fullname, tblrequest.menreq, tblrequest.exreq, tblrequest.category, tblrequest.lastday, tblrequest.file FROM tblrequest INNER JOIN tblrequestnotification ON tblrequest.Request_ID = tblrequestnotification.Req_ID WHERE tblrequest.status ='Pending'";
			if ($result = mysqli_query($con,$sql)) {
				if(mysqli_num_rows($result)>0){

					echo '<table class="table"><caption><h3 align="center"><b>Pending Approval</b></h3></caption>
			  			<thead>
							<tr><th scope="col"></th>
								<th scope="col">Full Name</th>
				  				<th scope="col">NIC</th>
				  				<th scope="col">Mention Request</th>
				  				<th scope="col">Explain</th>
				  				<th scope="col">Category</th>
				  				<th scope="col">Last Date</th>
				  				<th scope="col">File</th>
				  				<th scope="col"></th>
							</tr>
			  			</thead>
			  			<tbody>';
					while ($row = $result->fetch_assoc()) {

						$req_id = $row["Request_ID"];
						$nic = $row["nic"];
						$fname = $row["fullname"];
						$menreq = $row["menreq"]; 
						$exreq = $row["exreq"];
						$category = $row["category"];
						$lastday = $row["lastday"];
						$file = $row["file"];
						$not_id = $row["Notification_ID"];
	

						echo '<form action="" method="POST">
						<tr class="danger">
						 <td></td>  
						<td>'.$fname.'</td>
				        <td>'.$nic.'</td> 
				        <td>'.$menreq.'</td>
				        <td>'.$exreq.'</a></td>
				        <td>'.$category.'</a></td>
				        <td>'.$lastday.'</td>
				        <td><a href="../upload/'.$file.'">'.$file.'</a></td>
			
				        <td><button type="submit" class="btn btn-warning" name="approve">Approve</button>
				        <input type="hidden" name="hrid" value="'.$req_id.'"</td>
			  			<td><button type="submit" class="btn btn-danger" name="reject">Reject</button></td>
			  			<input type="hidden" name="hnotid" value="'.$not_id.'"</td>
			  			</form>
				      </tr>';
		  			}
		  			echo '</tbody></table>';	
		  		}
		  		else 
				{
					echo "<br><h3 align='center'>No Requests to Approve</h3>";
					echo "</br>";
				}  
  			}
		  			    
		  			

		?>
		<?php
			if(isset($_POST['approve'])){
				$key = $_POST['hrid'];
				$au_nic = $_SESSION["nic"];
			
				$qupdate = mysqli_query($con,"UPDATE `tblrequest` SET Status = 'Approved', handledBy='$au_nic' WHERE Request_ID = '$key'") or die("Action not successful".mysql_error());
				$qupdate2 = mysqli_query($con,"UPDATE `tblrequestnotification` SET Req_Status = '1' WHERE Notification_ID = '$not_id'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
			elseif(isset($_POST['reject'])){
				$key = $_POST['hrid'];
				$au_nic = $_SESSION["nic"];
				$not_id = $_POST['hnotid'];

				$qupdate = mysqli_query($con,"UPDATE `tblrequest` SET Status = 'Rejected',handledBy='$au_nic' WHERE Request_ID = '$key'") or die("Action not successful".mysql_error());
				$qupdate2 = mysqli_query($con,"UPDATE `tblrequestnotification` SET Req_Status = '1' WHERE Notification_ID = '$not_id'") or die("Action not successful".mysql_error());
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
		</br>
		</br>
		</br></div>
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

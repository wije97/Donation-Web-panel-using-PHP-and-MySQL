<?php
include_Once('../config.php');
$selected = '';

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


		
		<div class="fh5co-section-gray">
			<br>
		<table class="table"><caption><h3 align="center"><b>Manage Users</b></h3></caption>
				<tr> 
				  <th>
				  <form action="" method="POST">
				  <select class="form-control" id="user" name="user">
						<option>Select</option>
						<option value="tblrequester">Requester</option>
						<option value="tbldonor">Donor</option>
						<option value="tblauthorizer">Authorizer</option>
				   </select>				  
				  </th>
				  <th><button type="Submit" class="btn btn-info"  name="submit">Search</button></th>
				</tr>
				</form>
				</table>

				<?php
    				if(isset($_POST['submit'])){
    					if(!empty($_POST['user'])) {
        				$selected = $_POST['user'];
    					} 
    				}
    				if($selected == "tblrequester"){

			  			$sql = "SELECT * FROM tblrequester";
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){

								echo'<table class="table">
						  			<thead>
										<tr>
											<th scope="col"></th>
							  				<th scope="col">NIC</th>
							  				<th scope="col">First Name</th>
							  				<th scope="col">Last Name</th>
							  				<th scope="col">Occuparion</th>
							  				<th scope="col">Phone</th>
							  				<th scope="col">Address</th>
							  				<th scope="col"></th>
							  				<th scope="col"></th>
										</tr>
						  			</thead>
						  			<tbody>';
								while ($row = $result->fetch_assoc()) {
									$nic = $row["nic"];
									$fname = $row["fname"];
									$lname = $row["lname"];
									$occuparion = $row["occupation"];
									$phone = $row["telephone"];
									$address = $row["address"];

									echo '<form action="" method="POST">
									<tr class="danger"> 
									<td></td>
							        <td>'.$nic.'</td> 
							        <td>'.$fname.'</td> 
							        <td>'.$lname.'</td>
							        <td>'.$occuparion.'</td>
							        <td>'.$phone.'</td>
							        <td>'.$address.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hnic" value="'.$nic.'"><input type="hidden" name="type" value="requester"></td>
						  			<td><button type="submit" class="btn btn-danger" name="delete">Delete</button></td>
						  			</form>
							      </tr>';
					  			}	
					  		}else {
								echo "<br><h3 align='center'>No Data</h3>";
							}
			  		}
			  	echo '</tbody>';
			 echo'</table>';



			}
			elseif($selected == "tbldonor"){

			  			$sql = "SELECT * FROM tbldonor";
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){

		    				echo'<table class="table">
					  			<thead>
									<tr>
										<th scope="col"></th>
						  				<th scope="col">NIC</th>
						  				<th scope="col">First Name</th>
						  				<th scope="col">Last Name</th>
						  				<th scope="col">Phone</th>
						  				<th scope="col">Address</th>
						  				<th scope="col">Occuparion</th>
						  				<th scope="col"></th>
						  				<th scope="col"></th>
									</tr>
					  			</thead>
					  			<tbody>';

								while ($row = $result->fetch_assoc()) {
									$nic = $row["nic"];
									$fname = $row["fname"];
									$lname = $row["lname"];
									$phone = $row["telephone"];
									$address = $row["address"];
									$occupation = $row["occupation"];

									echo '<form action="" method="POST">
									<tr class="danger"> 
							        <td></td>
							        <td>'.$nic.'</td> 
							        <td>'.$fname.'</td> 
							        <td>'.$lname.'</td>
							        <td>'.$phone.'</td>
							        <td>'.$address.'</td>
							        <td>'.$occupation.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hnic" value="'.$nic.'"><input type="hidden" name="type" value="donor"></td>
						  			<td><button type="submit" class="btn btn-danger" name="delete">Delete</button></td>
						  			</form>
							      </tr>';
					  			}	
					  		}else {
								echo "<br><h3 align='center'>No Data</h3>";
							}
			  		}
			  	echo '</tbody>';
			 echo'</table>';
			}
			elseif($selected == "tblauthorizer"){

			  			$sql = "SELECT * FROM tblauthorizer WHERE Status = 'Approved'";
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){

								echo'<table class="table">
						  			<thead>
										<tr>
											<th scope="col"></th>
							  				<th scope="col">NIC</th>
							  				<th scope="col">First Name</th>
							  				<th scope="col">Last Name</th>
							  				<th scope="col">Email</th>
							  				<th scope="col">Phone</th>
							  				<th scope="col">Occuparion</th>
							  				<th scope="col">Address Residential</th>
							  				<th scope="col"></th>
							  				<th scope="col"></th>
										</tr>
						  			</thead>
						  			<tbody>';
								while ($row = $result->fetch_assoc()) {
									$nic = $row["nic"];
									$fname = $row["fname"];
									$lname = $row["lname"];
									$email = $row["email"];
									$phone = $row["telephone_mobile"];
									$occupation = $row["occupation"];
									$addressr = $row["address_residential"];
				

									echo '<form action="" method="POST">
									<tr class="danger"> 
							        <td></td>
							        <td>'.$nic.'</td> 
							        <td>'.$fname.'</td> 
							        <td>'.$lname.'</td>
							        <td>'.$email.'</a></td>
							        <td>'.$phone.'</td>
							        <td>'.$occupation.'</td>
							        <td>'.$addressr.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hnic" value="'.$nic.'"><input type="hidden" name="type" value="authorizer"></td>
						  			<td><button type="submit" class="btn btn-danger" name="delete">Delete</button></td>
						  			</form>
							      </tr>';
					  			}
					  		}else {
								echo "<br><h3 align='center'>No Data</h3>";
							}	
			  		}
			  	echo '</tbody>';
			 echo'</table>';
			}
			else {
				echo "<h3 align='center'>Please Select Valid User</h3>";
			}	
		?>
		<?php
			if(isset($_POST['view'])){
				$type = $_POST['type'];
				if($type== "requester"){
					$_SESSION["type"] = "requester";
  					$_SESSION["nic"] = $_POST['hnic'];
  					header("Location:../updateinfoRequester.php");
  					//header("Refresh:0; url=adminupdateinfoRequester.php");
				}
				elseif($type == "donor"){
					$_SESSION["type"] = "donor";
  					$_SESSION["nic"] = $_POST['hnic'];
  					header("Location:../updateinfoDonor.php");
  					//header("Refresh:0; url=adminupdateinfoDonor.php");
				}
				else{
					$_SESSION["type"] = "authorizer";
  					$_SESSION["nic"] = $_POST['hnic'];
  					header("Location:../updateinfoAuthorizer.php");
  					//header("Refresh:0; url=adminupdateinfoAuthorizer.php");
				}

			}

			if(isset($_POST['delete'])){
				$key = $_POST['hnic'];
				$type = $_POST['type'];
				if($type== "requester"){
					$qupdate = mysqli_query($con,"DELETE FROM `tblrequester` WHERE nic = '$key'") or die("Action not successful".mysql_error());

					$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequest` WHERE nic = '$key'") or die("Action not successful".mysql_error());

					$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequestnotification` WHERE Req_NIC = '$key'") or die("Action not successful".mysql_error());

					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");


				}
				elseif($type == "donor"){
					$qupdate = mysqli_query($con,"DELETE FROM `tbldonor` WHERE nic = '$key'") or die("Action not successful".mysql_error());
					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");
				}
				else{
					$qupdate = mysqli_query($con,"DELETE FROM `tblauthorizer` WHERE nic = '$key'") or die("Action not successful".mysql_error());
					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");
				}
			}

			?>		
		</br></br></br></br></br></br></br></br></br></br>
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

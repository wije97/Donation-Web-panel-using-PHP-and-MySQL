<?php
	include_Once('../config.php');

	session_start();
	$req_nic = $_SESSION['nic'];

	$sql = "SELECT fname, lname FROM tblrequester WHERE nic = '$req_nic' ";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$req_fname = $row['fname'];
	$req_lname = $row['lname'];
	$fullname = $req_fname ." " . $req_lname;

	if(isset($_POST["submit"]))
	{
		$fullname = $_POST['fullname'];
		$nic = $_POST['nic'];
		$menreq = $_POST['menreq'];
		$exreq = $_POST['exreq'];
		$catogery = $_POST['catogery'];
		$lastday = $_POST['lastday'];


		$file=$_FILES["myfile"]["name"];
		$tmp_name=$_FILES["myfile"]["tmp_name"];
		$path="../upload/".$file;
		$file1=explode(".",$file);
		$ext=$file1[1];
		$allowed=array("jpg","png","gif","pdf","wmv","pdf","zip");
		if(in_array($ext,$allowed)){
			move_uploaded_file($tmp_name,$path);
			$query = mysqli_query($con,"insert into tblrequest(nic,fullname,menreq,exreq,category,lastday,file,status)values('$nic','$fullname','$menreq','$exreq','$catogery','$lastday','$file','Pending')");
			if($query == 1){		

				$last_id = mysqli_insert_id($con);

				$insert1 ="INSERT INTO `tblrequestnotification` (Req_ID, req_NIC, Auth_Status, Req_Status) VALUES ('$last_id','$req_nic','1','2')";
				$query = mysqli_query($con, $insert1) or die(mysqli_error($con));

				if($query == 1){
					echo '<script>alert("Request Sent To Authorizer !")</script>';
				}
				
			}
			else{
				echo '<script>alert("Unsuccessful Requested..! !")</script>';
			}

		}

	}

?>

<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DONATE LANKA</title>
	
  
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	
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
					<h1 id="fh5co-logo"><a href="../index.php">DONATE LANKA</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="Requester_UI.php">Dashboard</a></li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Request</a>
								<ul class="fh5co-sub-menu">
									<li><a href="requestForm.php">Create request</a></li>
									<li><a href="../ViewReuest.php">View Request</a></li>
								</ul>
							</li>
							<li><a href="../chat/chat_index.php">Chat</a></li>
							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../logout.php">Logout</a></li>
							
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		
	
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-7">
								<div class="tabulation animate-box">

								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Request</a>
								      </li>
								      
								   </ul>

								    <form action="" method="POST" enctype="multipart/form-data">
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Full Name:</label>
													<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo (isset($fullname))?$fullname:'';?>" readonly=""/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">NIC:</label>
													<input type="text" class="form-control" id="nic" name="nic"  value="<?php echo (isset($req_nic))?$req_nic:'';?>" readonly=""/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Category:</label>
													<select class="form-control" id="catogery" name="catogery">
														<option>Health & Medical</option>
														<option>Education</option>
														<option>Human Services</option>
														<option>Animal & Humane</option>
														<option>Disaster Relief</option>
												    </select>
													
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Mention The Requirement:</label>
													<input type="text" class="form-control" id="menreq" name="menreq" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Explain Your Requirement:</label>
													<textarea type="text" id="exreq" name="exreq" class="form-control" cols="30" rows="5" required></textarea>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">When Is The Last Day You Need Money?:</label>
													<input type="date" class="form-control" id="lastday" name="lastday" min="<?= date('Y-m-d'); ?>" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												
												<div class="input-field">
												 <label class="input-group-text" for="inputGroupFile02">Proof Documents ( Upload as a PDF)</label>
												 <input type="file" class="form-control"  name="myfile" required="">
												  
												</div>
											</div>
											<div class="col-xxs-12 col-xs-4 mt alternate">
												<input type="submit" class="btn btn-primary1 btn-block" name="submit">
											</div>
										</form>

										</div>
									 </div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>

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


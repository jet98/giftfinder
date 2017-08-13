<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" type="image/png" href="../images/fav.png"/>
	<title>Project Location North</title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/user_edit.js"></script>
	<script type="text/javascript" src="../js/questions.js"></script>
	<script type="text/javascript" src="../js/userSavedQuestions.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>
	<script type="text/javascript" src="../js/upload.js"></script>
	<script type="text/javascript" src="../js/amazon/get_Items.js"></script>
	<script type="text/javascript" src="../js/searchBox.js"></script>
</head>
<body>
	<!-- top nav bar -->
	<div class="navbar navbar-full" id="header">
		<a class="navbar-brand" href="index.html.php"><img src="../images/navtitle.png" /></a>
		<ul class="nav navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="index.html.php">Home</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="gift_finder.html.php">Gift Finder</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="forum_home.html.php">Community</a>
			</li>
		</ul>
		<form class="form-inline pull-xs-right" id="search_div">
			<input class="form-control" id="search" type="text" placeholder="Search">
			<button class="btn btn-secondary search" type="button">Search</button>
		</form>
		<div class="navbar-left" id="home-logout-button">
			<button class="btn btn-secondary" type="button">Logout</button>
		</div>
	</div>
	<!-- main body -->
	<div class="container" id="main_body">
		<!-- profile picture / upload photo -->
		<div id="profile_picture">
			<h3 id="logo">Profile Picture</h3>
			<img src="<?php include_once '../php/userData.php'; echo uploadedFile(); ?>" id="edit-profile-picture" title="Profile Picture" />
			<form name="file" method="post" enctype="multipart/form-data">
				<input type="file" name="file_to_upload" id="file_to_upload">
				<input type="button" value="Upload Image" id="upload_file">
			</form>
			<div id="user_info">
				<h4 id="edit_page_username">
					<?php include_once '../php/userData.php'; echo username(); ?>
				</h4>
				<h4 id="edit_page_name">
					<?php include_once '../php/userData.php'; echo name(); ?>
				</h4>
				<h4 id="edit_page_email">
					<?php include_once '../php/userData.php'; echo email(); ?>
				</h4>
			</div>
		</div>
		<!-- edit profile form -->
		<div class="well" id="edit_profile">
			<h3>Edit Profile</h3>
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">Username:</label>
					<div class="col-md-8">
						<input class="form-control" type="text" id="username" value="<?php include_once '../php/userData.php'; echo username(); ?>" disabled="true">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Email:</label>
					<div class="col-md-8">
						<input class="form-control" type="text" id="email" value="<?php include_once '../php/userData.php'; echo email(); ?>" disabled="true">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">About Me:</label>
					<div class="col-md-8">
						<input class="form-control" type="text" id="about_me" value="<?php include_once '../php/userData.php'; echo aboutMe(); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<input type="button" class="btn btn-secondary" value="Save Changes" id="save-edit-button">
						<span></span>
						<input type="button" class="btn btn-secondary" value="Change Password" data-toggle="modal" data-target="#changePasswordModal">
					</div>
				</div>
			</form>
			<!-- change password modal -->
			<div id="changePasswordModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="change-password-error">Change Password</h4>
						</div>
						<div class="modal-body user-modal">
							<label>Current Password</label>
							<input class="form-control" type="password" placeholder="Enter Current Password" id="current-password" /></br>
							<label>New Password</label>
							<input class="form-control" type="password" placeholder="Enter New Password" id="enter-new-password" /></br>
							<label>Confirm Password</label>
							<input class="form-control" type="password" placeholder="Enter New Password" id="confirm-new-password"/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-secondary change-password-submit-button" data-dismiss="modal">Submit</button>
						</div>
					</div>
				</div>
			</div>
			<!-- questionnaire  -->
			<h3>Let's Personalize Your Search</h3>
			<form class="form-horizontal" method="POST" enctype="text/plain" id="user_form">
				<!-- location for user profile questions -->
			</form>
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-8">
					<button id="user_profile_save_button" type="button" class="btn btn-secondary">Save Profile</button>
				</div>
			</div>
		</div>
	</div>
	<!-- div results from search -->
	<div class="container" id="search_results_body">
		<!-- seperate list by API -->
		<!-- <div class="container" id="shopping_list">
			<table class="table" id="full_width">
				<thead>
					<tr>
						<th>Shop List</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="amazon">Amazon</td>
					</tr>
					<tr>
						<td>Shop2</td>
					</tr>
				</tbody>
			</table>
		</div> -->
		<!-- list of results -->
		<div class="container well" id="results_list">
		</div>
	</div>
	<!-- footer -->
	<div class="footer">
		<h5><a href="#" id="footer-contacts">Contact</a> Finding Kita</h5>
	</div>
</body>
</html>

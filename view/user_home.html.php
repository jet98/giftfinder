<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" type="image/png" href="../images/fav.png"/>
	<title>Project Location North</title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/tabletools/2.2.1/css/dataTables.tableTools.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/user_home.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>
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
		<!-- user profile -->
		<div class="well" id="users_profile">
			<div class="container" id="full_width">
				<div class="text-center" id="users_profile_image">
					<h3 id="username">
						<?php include_once '../php/userdata.php'; echo username(); ?>
					</h3>
					<img src="<?php include_once '../php/userData.php'; echo uploadedFile(); ?>" id="edit-profile-picture" /></br>
					<a href="user_edit.html.php">Edit</a> | <a id="delete_profile" href="#">Delete Profile</a>
				</div>
				<div id="profile_info">
					<?php include_once '../php/userData.php'; echo aboutMe(); ?>
				</div>
			</div>
		</div>
		<!-- user activity -->
		<div class="well" id="users_profile">
			<div class="container" id="full_width">
				<h3 id="username">Username<span>'s Activity</span></h3>
				<div id="users_profile_info">
					<!-- post -->
					<table class="table well" id="table_well">
						<thead>
							<tr>
								<th id="user-table-post">Latest Post</th>
								<th id="user-table-comment">Comment</th>
								<th id="user-table-date">Date</th>
							</tr>
						</thead>
					</table>
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

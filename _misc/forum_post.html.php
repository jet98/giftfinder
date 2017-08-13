<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" type="image/png" href="../images/fav.png"/>
	<title>Project Location North</title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/forum.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>
	<script type="text/javascript" src="../js/amazon/get_Items.js"></script>
	<script type="text/javascript" src="../js/amazon/search_results.js"></script>
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
			<button class="btn btn-secondary" type="submit">Search</button>
		</form>
		<div class="navbar-left" id="home-logout-button">
			<button class="btn btn-secondary" type="button">Logout</button>
		</div>
	</div>
	<!-- main body -->
	<div class="container" id="main_body">
    <div class="container forum-topics">
			<!-- topics list -->
			<table class="table well" id="forum-topic-table">
				<thead class="topic-thread">
					<tr>
						<th id="forum-post-author">Author</th>
						<th id="forum-post-post">Posts</th>
            <th id="forum-post-reply">Reply</th>
					</tr>
				</thead>
				<!-- remove later -->
				<tbody>
					<tr>
						<td id="forum-post-author">
              <img src="<?php include_once '../php/userData.php'; echo uploadedFile(); ?>" id="forum-profile-picture" />
              <h4 id="forum-post-username"><?php include_once '../php/userData.php'; echo username(); ?></h4>
              <h4 id="forum-post-date">12-12-12</h4>
            </td>
						<td id="forum-post-post">This is an example of a post the user makes</td>
            <td id="forum-post-reply">
              <div class="create-post-button">
                <a href="#" title="Reply">&#10226</a>
                <a href="#" title="Quote">&#10557</a>
              </div>
            </td>
					</tr>
				</tbody>
				<!-- remove later -->
        <tbody>
					<tr>
						<td id="forum-post-author">
              <img src="<?php include_once '../php/userData.php'; echo uploadedFile(); ?>" id="forum-profile-picture" />
              <h4 id="forum-post-username"><?php include_once '../php/userData.php'; echo username(); ?></h4>
              <h4 id="forum-post-date">12-12-12</h4>
            </td>
						<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</td>
            <td id="forum-post-reply">
              <div class="create-post-button">
                <a href="#" title="Reply">&#10226</a>
                <a href="#" title="Quote">&#10557</a>
              </div>
            </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="forum-footer">
		<h5><a href="#" id="footer-contacts">Contact</a> Finding Kita</h5>
	</div>
</body>
</html>

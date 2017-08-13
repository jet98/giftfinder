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
	<script type="text/javascript" src="../js/forum/forum_home.js"></script>
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
      <div class="container create-thread-button">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#createThread" type="submit">Create Thread</button>
      </div>
			<!-- create thread modal -->
			<div id="createThread" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body user-modal">
							<label>Title</label>
							<input class="form-control" type="text" id="create_thread_title" placeholder="Enter Title" /></br>
							<label>Post</label>
							<textarea class="form-control" rows="3" id="create_thread_post" placeholder="Enter Post"></textarea>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-secondary create-thread-submit-button" data-dismiss="modal">Submit</button>
						</div>
					</div>
				</div>
			</div>
			<!-- thread list -->
			<table class="table well" id="forum-thread-table">
				<thead class="topic-thread">
					<tr>
						<th id="thread-title-head">Thread</th>
						<th>Posts</th>
						<th>Last Post</th>
					</tr>
				</thead>
				<tbody id="forum_thread_body">
				</tbody>
			</table>
		</div>
	</div>
  <div class="forum-footer">
		<h5><a href="#" id="footer-contacts">Contact</a> Finding Kita</h5>
	</div>
</body>
</html>

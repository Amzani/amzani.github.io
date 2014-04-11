<html>
<head>
	<meta charset="UTF-8">
	<script src="http://popcornjs.org/code/dist/popcorn-complete.min.js"></script>
	<script src="http://toolness.github.io/instapoppin/instapoppin.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

</head>

<body>
	<article id="demo">
	<!-- Video Embed -->
	<video  id="video" class="primary-sync-source" height="auto" width="100%" controls autoplay >
		<source src="http://www.dailymotion.com/cdn/H264-1280x720/video/x1n2dg4.mp4?auth=1397391665-128-v2d40kk6-25e04b928a9b0eff76059f52b8b4eb54"></source>
	</video>
	<div id="container">
		<?php 
			include 'parse.php';
			echo generatePersonsCues();
		 ?>
	</div>
</article>
</body>
</html>
<!-- 
			Name:	Name:
			nickName:	NickName:
			photo	An image link
			title	The person’s title (for example, “Financial Manager”)
			Role:	The person’s Role: (for example, “Accountant”)
			url	Link to a web page, such as the person’s home page
			affiliation	The Name: of an organization with which the person is associated (for example, an employer)
			friend	Identifies a social relationship between the person described and another person
			contact	Identifies a social relationship between the person described and another person
			acquaintance	Identifies a social relationship between the person described and another person
			address	The location of the person. Can have the subproperties street-address, locality, region, postal-code, and country-å.
			-->
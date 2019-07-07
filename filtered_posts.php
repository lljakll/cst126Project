<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php include('includes/head_section.php'); ?>
<?php 
	// Get posts under a particular tag
	if (isset($_GET['tag'])) {
		$tag_id = $_GET['tag'];
		$posts = getPublishedPostsByTag($tag_id);
	}
?>
	<title>LifeBlog | Home </title>
</head>
<body>
<div class="container">
<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
<!-- // Navbar -->
<!-- content -->
<div class="content">
	<h2 class="content-title">
		Articles on <u><?php echo getTagNameById($tag_id); ?></u>
	</h2>
	<hr>
	<?php foreach ($posts as $post): ?>
		<div class="post" style="margin-left: 0px;">
			<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
			<a href="single_post.php?post-id=<?php echo $post['id']; ?>">
				<div class="post_info">
					<h3><?php echo $post['title'] ?></h3>
					<div class="info">
						<span><?php echo date("F j, Y ", strtotime($post["created"])); ?></span>
						<span class="read_more">Read more...</span>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>
<!-- // content -->
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
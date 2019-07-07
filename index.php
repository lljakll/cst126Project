<!-- The first include should be config.php -->
<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>

<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>LifeBlog | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // navbar -->

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>
			<!-- more content still to come here ... -->

			<?php foreach ($posts as $post): ?>
				<div class="post" style="margin-left: 0px;">
					<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
			        <!-- Added this if statement... -->
					<?php if (isset($post['tag']['name'])): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_posts.php?tag=' . $post['tag']['id'] ?>"
							class="btn category">
							<?php echo $post['tag']['name'] ?>
						</a>
					<?php endif ?>

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
		<!-- // Page content -->

		<!-- footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // footer -->
<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php
    if (isset($_GET['post-slug'])) {
        $post = getPost($_GET['post-slug']);
    }
    $topics = getAllTopics();
?>

<?php include('includes/head_sectionphp'); ?>
<title> <?php echo $post['title'] ?> </title>
</head>
<body>
<div class="container">

    <?php include( ROOT_PATH . '/includes/navbar.php'); ?>

    <div class="content">

        <div class="post-wrapper">
            <?php if ($post['published'] == false): ?>
                <h2 class="post-title">This post is not published</h2>
            <?php else: ?>
                <h2 class="post-title"><?php echo $post['title']; ?></h2>
                <div class="post-body-div">
                    <?php echo html_entity_decode($post['body']); ?>
                </div>
            <?php endif ?>
        </div>
        
        <div class="post-sidebar">
            <div class="card">
                <div class="card-header">
                    <h2>TAGS</h2>
                </div>
                <div class="card-content">
                    <?php foreach ($tags as $tag): ?>
                        <a href="<?php echo BASE_URL . 'filtered_posts.php?tags=' . $tag['id'] ?>">
                        <?php echo $tag['name']; ?>
                        </a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include( ROOT_PATH . '/includes/footer.php'); ?>

<?php 
/* * * * * * * * * * * * * * *
* Returns all published posts
* * * * * * * * * * * * * * */
function getPublishedPosts() {
	// use global $conn object in function
	global $conn;
	$sql = "SELECT * FROM posts WHERE published=true";
	$result = mysqli_query($conn, $sql);
	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['tag'] = getPostTag($post['id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * *
* Receives a post id and
* Returns tag of the post
* * * * * * * * * * * * * * */
function getPostTag($post_id){
	global $conn;
	$sql = "SELECT * FROM tags WHERE id=
			(SELECT tag_id FROM post_tags WHERE post_id=$post_id) LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$tag = mysqli_fetch_assoc($result);
	return $tag;
}



/* * * * * * * * * * * * * * * *
* Returns all posts under a tag
* * * * * * * * * * * * * * * * */
function getPublishedPostsByTag($tag_id) {
	global $conn;
	$sql = "SELECT * FROM posts ps 
			WHERE ps.id IN 
			(SELECT pt.post_id FROM post_tag pt 
				WHERE pt.tag_id=$tag_id GROUP BY pt.post_id 
				HAVING COUNT(1) = 1)";
	$result = mysqli_query($conn, $sql);
	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['tag'] = getPostTag($post['id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * * *
* Returns tag name by tag id
* * * * * * * * * * * * * * * * */
function getTagNameById($id)
{
	global $conn;
	$sql = "SELECT name FROM tags WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$tag = mysqli_fetch_assoc($result);
	return $tag['name'];
}

/* * * * * * * * * * * * * * *
* Returns a single post
* * * * * * * * * * * * * * */
function getPost($id){
	global $conn;
	// Get single post id
	$post_id = $_GET['post-id'];
	$sql = "SELECT * FROM posts WHERE id='$post_id' AND published=true";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		// get the tag to which this post belongs
		$post['tag'] = getPostTag($post['id']);
	}
	return $post;
}
/* * * * * * * * * * * *
*  Returns all tags
* * * * * * * * * * * * */
function getAllTags()
{
	global $conn;
	$sql = "SELECT * FROM tags";
	$result = mysqli_query($conn, $sql);
	$tags = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $tags;
}




?>
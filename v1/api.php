<?php
$blogName = $path[2];

// $query = "select latest_three_blogs.blog_id, latest_three_blogs.blog_title as title, latest_three_blogs.blog_sub_title as subTitle, ";
// $query .= "latest_three_users.user_avatar as avatar, latest_three_users.user_fullname as author ";
// $query .= "from latest_three_blogs join latest_three_users using (user_id) ";
// $query .= "where blog_name = '" . $blogName . "'";

// $result = $GLOBALS['database']->executeQuery($query);

// if ($row = $GLOBALS['database']->getNextRow($result)) {
// 	$json['blog'] = $row;
// } else {
// 	require '../includes/code_404.php';
// }

// echo $path[3];

switch ($path[3]) {
case 'blog':
	$query = "select latest_three_blogs.blog_id, latest_three_blogs.blog_title as title, latest_three_blogs.blog_sub_title as subTitle, ";
	$query .= "latest_three_users.user_avatar as avatar, latest_three_users.user_fullname as author ";
	$query .= "from latest_three_blogs join latest_three_users using (user_id) ";
	$query .= "where blog_name = '" . $blogName . "'";

	$result = $GLOBALS['database']->executeQuery($query);

	if ($row = $GLOBALS['database']->getNextRow($result)) {
		$json['blog'] = $row;
	} else {
		require '../includes/code_404.php';
	}
	break;

case 'posts':
	$query = "select latest_three_blogs.blog_id, latest_three_posts.* from latest_three_blogs ";
	$query .= "left join latest_three_posts using (blog_id) where blog_name = '" . $blogName . "'";
	
	$result = $GLOBALS['database']->executeQuery($query);
	$json['posts'] = array();
	while ($row = $result->fetch_assoc()) {
		$json['posts'][] = $row;
	}
	break;

case 'upload':
	// \Cloudinary\Uploader::unsigned_upload("sample.jpg", "unsigned_1", 
    // array("cloud_name" => "demo"));
	break;

default:
	# code...
	break;
}
?>
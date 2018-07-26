<?php
$blogName = $path[2];

// if ($blogName == 'blog_template') {
// 	require '../templates/blog_template.php'
// 	exit;
// }
// if ($blogName == 'post_template') {
// 	require '../templates/post_template.php'
// 	exit;
// }


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

// $postObject['blog']['title'] = "Last 3";
// $postObject['blog']['subTitle'] = "Last 3";
// $postObject['blog']['avatar'] = "https://picsum.photos/400/?image=40";

switch ($path[3]) {
case 'blog_template':
	// $postObject['template'] = "blog_template";
	ob_start();
	include realpath($_SERVER["DOCUMENT_ROOT"] . '/templates/blog_template.php');
	$html = ob_get_clean();
	echo $html;
	exit;

case 'post_template':
	$postObject['template'] = "post_template";
	require realpath( $_SERVER["DOCUMENT_ROOT"] . '/templates/blog_template.php');
	exit;

case 'blog':
	$query = "select latest_three_blogs.blog_id, latest_three_blogs.blog_title as title, latest_three_blogs.blog_sub_title as subTitle, ";
	$query .= "latest_three_users.user_avatar as avatar, latest_three_users.user_fullname as author ";
	$query .= "from latest_three_blogs join latest_three_users using (user_id) ";
	$query .= "where blog_name = '" . $blogName . "'";

	$result = $GLOBALS['database']->executeQuery($query);

	// print_r($result);

	if ($row = $GLOBALS['database']->getNextRow($result)) {
		$json['blog'] = $row;
	} else {
		require realpath( $_SERVER["DOCUMENT_ROOT"] . '/includes/code_404.php');
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

default:
	# code...
	break;
}
?>
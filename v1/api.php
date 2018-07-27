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
// case 'link':
// 	$json = "<html><head><meta http-equiv='Access-Control-Allow-Origin' content='*'></head>
// 	<body>
// 	{
// 		'blog': {
// 	        'avatar': {
// 	 			'path': 'v1532646087/avatar_a73cvs.jpg',
// 	 			'secure_url': 'https://res.cloudinary.com/reblevins/image/upload/v1532646087/avatar_a73cvs.jpg'
// 			},
// 	        'blog_id': '9fcde7d0c2f9344133ff5e2766ac6de1a1547854cedc79a8bab1ccabc27ef7',
// 			'name': 'last-three',
// 			'subTitle': 'Just three posts',
// 			'title': 'Last Three'
// 	    },
// 	    'posts': [
// 	    	{
// 	    		'post_title': 'First Post',
// 	    		'date_published': '2018-07-26',
// 	    		'post_excerpt': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.',
// 	    		'post_full_text': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui.',
// 	    		'post_id': 1,
// 	    		'post_image': {
// 	    			'path': 'v1532637262/trekking_1_cdf6k0.jpg',
// 	    			'secure_url': 'https://res.cloudinary.com/reblevins/image/upload/v1532637262/trekking_1_cdf6k0.jpg'
// 	    		}
// 	    	},
// 	    	{
// 	    		'post_title': 'Second Post',
// 	    		'date_published': '2018-07-26',
// 	    		'post_excerpt': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.',
// 	    		'post_full_text': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui.',
// 	    		'post_id': 2,
// 	    		'post_image': {
// 	    			'path': 'v1532637262/trekking_1_cdf6k0.jpg',
// 	    			'secure_url': 'https://res.cloudinary.com/reblevins/image/upload/v1532637262/trekking_1_cdf6k0.jpg'
// 	    		}
// 	    	},
// 	    	{
// 	    		'post_title': 'Third Post',
// 	    		'date_published': '2018-07-26',
// 	    		'post_excerpt': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.',
// 	    		'post_full_text': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui.',
// 	    		'post_id': 3,
// 	    		'post_image': {
// 	    			'path': 'v1532637262/trekking_1_cdf6k0.jpg',
// 	    			'secure_url': 'https://res.cloudinary.com/reblevins/image/upload/v1532637262/trekking_1_cdf6k0.jpg'
// 	    		}
// 	    	}
//     	]
//     }</body></html>";
// 	$link = convertHTMLToLink($json);
// 	$link = "https://itty.bitty.site/#/" . $link;
// 	exit;

case 'blog_template':
	// $postObject['template'] = "blog_template";
	foreach ($postObject['posts'] as $key => $currentPost) {
		
	}
	ob_start();
	include realpath($_SERVER["DOCUMENT_ROOT"] . '/templates/blog_template.php');
	$html = ob_get_clean();
	// echo $html;
	$blogLink = convertHTMLToLink($html);
	echo "https://itty.bitty.site/#" . $blog['title'] . "/" . $blogLink;
	exit;

case 'post_template':
	$postObject['template'] = "post_template";
	// print_r($postObject['posts'][0]);
	$currentPost = $postObject['posts'][0];
	ob_start();
	include realpath( $_SERVER["DOCUMENT_ROOT"] . '/templates/blog_template.php');
	$html = ob_get_clean();
	echo $html;
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
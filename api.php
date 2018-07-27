<?php
require_once 'includes/startup.inc';
require_once 'includes/functions.php';
// print_r($GLOBALS['database']->conn);
// exit;

$json = array();
// parse the post header before loading shared.inc
$postObject = array();
if (empty($_POST) && file_get_contents("php://input")) {
	$headerInput = file_get_contents("php://input");
	$postObject = json_decode($headerInput,true);
	if (json_last_error() != JSON_error_NONE) {
		$json['status'] = "error";
		$json['message'] = "JSON format error from posted input: " . json_last_error_msg();
		echo json_encode($json);
		exit;
	}
} else {
	$postObject = $_POST;
}

// $postObject = array(
//     "blog" => array(
//         "avatar" => array(
// 			"path" => "v1532646087/avatar_a73cvs.jpg",
// 			"secure_url" => "https://res.cloudinary.com/reblevins/image/upload/v1532646087/avatar_a73cvs.jpg"
// 		),
//         "blog_id" => "9fcde7d0c2f9344133ff5e2766ac6de1a1547854cedc79a8bab1ccabc27ef7",
// 		"name" => "last-three",
// 		"subTitle" => "Just three posts",
// 		"title" => "Last Three"
//     ),
//     "posts" => array(
//     	array(
// 			"post_title" => "First Post",
// 			"date_published" => "2018-07-26",
// 			"post_excerpt" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.",
// 			"post_full_text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui.",
// 			"post_id" => 1,
// 			"post_image" => array(
// 				"path" => "v1532637262/trekking_1_cdf6k0.jpg",
// 				"secure_url" => "https://res.cloudinary.com/reblevins/image/upload/v1532637262/trekking_1_cdf6k0.jpg"
// 			)
// 		),
// 		array(
// 			"post_title" => "Second Post",
// 			"date_published" => "2018-07-26",
// 			"post_excerpt" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.",
// 			"post_full_text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui.",
// 			"post_id" => 2,
// 			"post_image" => array(
// 				"path" => "v1532637262/trekking_1_cdf6k0.jpg",
// 				"secure_url" => "https://res.cloudinary.com/reblevins/image/upload/v1532637262/trekking_1_cdf6k0.jpg"
// 			)
// 		),
// 		array(
// 			"post_title" => "Third Post",
// 			"date_published" => "2018-07-26",
// 			"post_excerpt" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit.",
// 			"post_full_text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget finibus tortor. Aliquam nunc orci, tempus ut ultrices et, aliquet eget velit. Proin feugiat dapibus eros, vitae varius leo varius vel. Nullam facilisis, neque non blandit interdum, mauris massa viverra lectus, vitae lobortis turpis ipsum dictum libero. Nam blandit lacus ac massa aliquam, non finibus ligula sodales. Maecenas in semper ante, non imperdiet purus. Nam eu nibh et mi pharetra semper. Mauris sagittis massa vel ligula molestie facilisis ut eget tortor. Praesent diam justo, malesuada non molestie ac, scelerisque quis lacus. Nullam dictum posuere mi at volutpat. Etiam rutrum eleifend diam, porttitor sodales tellus. Nullam id risus tempor justo molestie facilisis. Etiam in elit sit amet ipsum semper malesuada. Cras tincidunt velit eu auctor ullamcorper. In sit amet nunc rutrum, pretium nisl vitae, lacinia dui. In dapibus vehicula odio quis ornare. Nam luctus mi quis nibh pellentesque ornare. Nunc leo mi, cursus in congue ac, eleifend in erat. Donec sit amet felis sollicitudin, fringilla nibh nec, ultrices nisl. Ut quis vestibulum turpis, eu suscipit turpis. Curabitur ut dui ut sapien maximus placerat. Suspendisse nec lorem eget ligula commodo feugiat. Fusce cursus velit ut rhoncus cursus. Morbi auctor accumsan aliquam. Mauris vulputate fermentum blandit. Suspendisse potenti. Sed pharetra vestibulum neque sed aliquet. Quisque scelerisque tristique venenatis. Nulla malesuada scelerisque viverra. Sed ac consequat nisi, a ullamcorper enim. Sed vestibulum, metus ac tempus lobortis, tellus metus porta elit, at semper est dolor a urna. Nullam pulvinar eleifend leo et sagittis. Nullam suscipit, ante eu egestas ultrices, ex leo vulputate neque, at pulvinar purus velit sagittis odio. Pellentesque nec aliquet purus. Etiam porta velit quam, vel lobortis magna vehicula sit amet. Etiam laoreet egestas ligula, non venenatis quam vehicula at. Cras nec enim blandit, volutpat elit quis, sagittis neque. Nam gravida, nibh sed posuere blandit, erat nisi pretium nisi, eu euismod dui mi eget elit. Nulla semper vestibulum lectus a efficitur. Curabitur elementum eleifend dui.",
// 			"post_id" => 3,
// 			"post_image" => array(
// 				"path" => "v1532637262/trekking_1_cdf6k0.jpg",
// 				"secure_url" => "https://res.cloudinary.com/reblevins/image/upload/v1532637262/trekking_1_cdf6k0.jpg"
// 			)
// 		)
//     )
// );

// print_r($postObject);

switch ($path[1]) {
	case "v1":
	case "v2":
		// require_once $path[1] . "/api.php";
		require_once "v1/api.php";
		break;
	default:
		http_response_code(404);
		include 'includes/code_404.php';
		die();
}

mysqli_close($db);
echo json_encode($json);
?>
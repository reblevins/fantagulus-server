<?php
$path = explode("/", $_GET['path']);

switch ($path[0]) {
	case "api":
		require_once "api.php";
		break;

	case "blogs":
		require_once "templates/blog.php";
		break;

	default:
		http_response_code(404);
		include 'includes/code_404.php';
		die();
}
exit;
?>

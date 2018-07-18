<?php

require_once 'includes/startup.inc';

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

$path = explode("/", $_GET['path']);

switch ($path[1]) {
	case "v1":
		require_once $path[1] . "/api.php";
		break;
	default:
		http_response_code(404);
		include 'includes/code_404.php';
		die();
}

mysqli_close($DBConnection);
echo json_encode($json);
exit;
?>

<?php
$blogName = $path[1];

$blogDir = $_SERVER["DOCUMENT_ROOT"] . '/blog_data/' . $blogName;

if (is_dir($blogDir)) {
	require $blogDir . '/index.php';
	exit;
} else {
	echo "Oops";
	exit;
}
?>
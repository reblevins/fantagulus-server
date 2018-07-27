<?php
function formatDate($date, $format = 'Y-m-d') {
	$date = date_create($date);
	return date_format($date, $format);
}

function convertHTMLToLink($html, $arch = 'mac') {
	// $command = escapeshellarg('echo -n "' . $html . '" | lzma -9 | base64 | printf "https://itty.bitty.site/#/%s\n" "$(cat -)"');
	$file = $_SERVER["DOCUMENT_ROOT"] . '/tmp/json.txt';
	echo $file;
	$handle = fopen($file, 'w') or die('Cannot open file:  ' . $file);
	fwrite($handle, $html);
	fclose($handle);
	exec('lzma -9 ' . $file, $output);
	print_r($output);
	
	$command2 = 'base64 ' . $file . '.lzma';
	$output2 = shell_exec($command2);
	echo $output2;
	// unlink($file);
	// unlink($file . '.lzma');
	return $myvar;
}
?>
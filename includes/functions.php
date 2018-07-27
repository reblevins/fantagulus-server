<?php
function formatDate($date, $format = 'Y-m-d') {
	$date = date_create($date);
	return date_format($date, $format);
}

function convertHTMLToLink($html, $arch = 'mac') {
	// $command = escapeshellarg('echo -n "' . $html . '" | lzma -9 | base64 | printf "https://itty.bitty.site/#/%s\n" "$(cat -)"');
	$file = $_SERVER["DOCUMENT_ROOT"] . '/tmp/file.' . time() . '.txt';
	// echo $file;
	$handle = fopen($file, 'w') or die('Cannot open file:  ' . $file);
	fwrite($handle, $html);
	fclose($handle);
	exec('/usr/local/bin/lzma -9 ' . $file, $output, $error);
	// print_r($output);
	// echo $error;
	
	$command2 = '/usr/bin/base64 ' . $file . '.lzma';
	exec($command2, $output2, $error2);
	// echo $error2;
	// print_r($output2);
	// unlink($file);
	unlink($file . '.lzma');
	return $output2[0];
}
?>
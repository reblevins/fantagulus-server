<?php
function formatDate($date, $format = 'Y-m-d') {
	$date = date_create($date);
	return date_format($date, $format);
}

function convertHTMLToLink($html, $arch) {
	
}
?>
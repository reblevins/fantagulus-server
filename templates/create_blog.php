<?php
$blogPage = file_get_contents("blog.php");
$link = shell_exec('echo -n ' . $blogPage . ' | lzma -9 | base64 -w0 | printf "https://itty.bitty.site/#/%s\n" "$(cat -)"');
echo $link
?>
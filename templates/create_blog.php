<?php
require_once('../includes/simple_html_dom.php');

$html = file_get_html('https://itty.bitty.site/#blog.json/?XQAAAAJZCgAAAAAAAAAeGQknmB6SHqrph7Aauw1ZDjghW2+zl/udlDBkxFCjzGBETrdfVc2w/HVNqUj4+OyjTo4AUVIHPyf76VF6BL++8WRI1bKi2MarkrufR1wvDPnjVM37QmhTcrvNtimoYg01x5pIyTjzbEXCP6DyHH4fxM3yDlQzPDs+XJFK8FM/xHN5AZ4PMI5pgW2prjeUV5+FNeT8Bu6dJplFbCTYk+iOjM9hYvIrDAO9dV5Q70vhMb4OQ5k+a5dZO/N9FZG4FMLuV982jont09508TFkdySm7tkBfpGap1HIFeAiOUkXfQ83hTtiiUoZETKsrMPBQvsEKyMhFFF8VItyyXxNyfUe4TxgWdf8Te6LQPFkd9TY29s5D2ONZRYoYijvaEEVu7BFipcpPvwn7D+LerlxPyZ506BvwtG1QHUqY4K7AcbppNlbAsnvHgHFnsnLf4D1dlzliAn7z9BI3p8LR7fifMskbT9ULKKTFpp60F22iYrzfceq0x+OTtnCsTTKfHtrCkfUTGpOyYp9krugc0EesaazOCLEECDRvsDoECdLbfw8QacDMIxAMTQkVQnP5NrugcSc4pLQFBmpH2TcFeX1N0/CUX3rbHh5Es4YhE4ayf/6TOIa');

echo file_get_html('https://itty.bitty.site/#blog.json/?XQAAAAJZCgAAAAAAAAAeGQknmB6SHqrph7Aauw1ZDjghW2+zl/udlDBkxFCjzGBETrdfVc2w/HVNqUj4+OyjTo4AUVIHPyf76VF6BL++8WRI1bKi2MarkrufR1wvDPnjVM37QmhTcrvNtimoYg01x5pIyTjzbEXCP6DyHH4fxM3yDlQzPDs+XJFK8FM/xHN5AZ4PMI5pgW2prjeUV5+FNeT8Bu6dJplFbCTYk+iOjM9hYvIrDAO9dV5Q70vhMb4OQ5k+a5dZO/N9FZG4FMLuV982jont09508TFkdySm7tkBfpGap1HIFeAiOUkXfQ83hTtiiUoZETKsrMPBQvsEKyMhFFF8VItyyXxNyfUe4TxgWdf8Te6LQPFkd9TY29s5D2ONZRYoYijvaEEVu7BFipcpPvwn7D+LerlxPyZ506BvwtG1QHUqY4K7AcbppNlbAsnvHgHFnsnLf4D1dlzliAn7z9BI3p8LR7fifMskbT9ULKKTFpp60F22iYrzfceq0x+OTtnCsTTKfHtrCkfUTGpOyYp9krugc0EesaazOCLEECDRvsDoECdLbfw8QacDMIxAMTQkVQnP5NrugcSc4pLQFBmpH2TcFeX1N0/CUX3rbHh5Es4YhE4ayf/6TOIa')->plaintext;

// foreach($html->find('div') as $div) {
// 	echo $div->innerHTML;
// };
?>
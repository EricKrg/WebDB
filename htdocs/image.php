<?php
Header("Content-type: image/gif");
$im = imagecreate(300, 50);
$text_color = ImageColorAllocate ($im, 255, 255, 255);
$bg_color = ImageColorAllocate ($im, 0, 0, 255);
ImageFilledRectangle($im, 0, 0, 300, 50, $bg_color);
ImageString($im, 5, 10, 15, "Hello World!", $text_color);
ImageGif($im);
ImageDestroy($im);
?>
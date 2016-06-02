
<?php
// Load the stamp and the photo to apply the watermark to
$im = imagecreatefromjpeg('photo.jpg');

// First we create our stamp image manually from GD
$stamp = imagecreatetruecolor(400, 280);
imagefilledrectangle($stamp, 0, 0, 99, 69, 0x0000FF);
imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
$im = imagecreatefromjpeg('photo.jpg');
imagestring($stamp, 5, 20, 20, 'libGD', 0x0000FF);
imagestring($stamp, 3, 20, 40, '(c) 2007-9', 0x0000FF);

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 10;
$marge_bottom = 10;

$stamp1 = imagecreatefromjpeg('anto.jpg');

$sx = imagesx($stamp1);
$sy = imagesy($stamp1);

// Merge the stamp onto our photo with an opacity of 50%
imagecopymerge($im, $stamp1, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp1), imagesy($stamp1), 40);

// Save the image to file and free memory
imagepng($im, 'photo_stamp.png');
imagedestroy($im);

?>

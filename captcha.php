<?php
// captcha.php - Generate Verification Code
session_start();
$code = "";
for ($i = 0; $i < 4; $i++) $code .= rand(0, 9);
$_SESSION['captcha'] = $code;

header('Content-Type: image/png');
$im = imagecreatetruecolor(100, 40);
$bg_color = imagecolorallocate($im, 240, 240, 240);
$text_color = imagecolorallocate($im, 50, 50, 50);
$line_color = imagecolorallocate($im, 200, 200, 200);

imagefill($im, 0, 0, $bg_color);
for ($i = 0; $i < 5; $i++) imageline($im, rand(0, 100), rand(0, 40), rand(0, 100), rand(0, 40), $line_color);
for ($i = 0; $i < 4; $i++) imagechar($im, 5, 20 + ($i * 15), 10, $code[$i], $text_color);

imagepng($im);
imagedestroy($im);
?>

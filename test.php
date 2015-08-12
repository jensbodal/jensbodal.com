<?php

$pdf_file = 'a.pdf';
$out_file = '/tmp/a.jpg';
$handle = fopen('https://www.sharelatex.com/github/repos/jensbodal/cv/builds/latest/output.pdf', 'rb');
copy($handle, '/var/www/jensbodal.com/public_html/assets/files/test.jpg');
$im = new Imagick();
$im->setResolution(300, 300);
$im->readImageFile($handle);
$im->setImageFormat("jpeg");

//$im->writeImage($out_file);
$output = $im->getImage();
$output_type = $im->getFormat();


header("Content-type: $output_type");
echo $output;
?>

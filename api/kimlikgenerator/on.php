<?php

include "config/img.php";

$checkCooldown = checkCooldown($kid);
if ($checkCooldown["success"] == "false") {
    die(json_encode($checkCooldown));
} else {
    addCooldown($kid);
}

$duzenleGetFront = imagecreatefromstring($olusturDetay['0']);

//tc
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 42, 0, 80, 222, $siyah, $olusturDetay['2'], $yazDetay["tc"]);

//soyad
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 39, 0, 468, 355, $siyah, $olusturDetay['2'], $yazDetay["soyad"]);

//ad
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 39, 0, 465, 447, $siyah, $olusturDetay['2'], $yazDetay["ad"]);

//dogum
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 39, 0, 465, 547, $siyah, $olusturDetay['2'], $yazDetay["dogum"]);

//cinsiyet
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 39, 0, 827, 547, $siyah, $olusturDetay['2'], $yazDetay["cinsiyet"]);

//serino
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 39, 0, 465, 640, $siyah, $olusturDetay['2'], $yazDetay["seri_no"]);

//son gecerlilik tarihi
$siyah = imagecolorallocate($duzenleGetFront, 47, 42, 39);
imagettftext($duzenleGetFront, 39, 0, 465, 732, $siyah, $olusturDetay['2'], $yazDetay["songecerlilik"]);

imagefilter($duzenleGetFront, IMG_FILTER_BRIGHTNESS, 25);

//vesika
$GetVesikalik = $img;
imagefilter($GetVesikalik, IMG_FILTER_BRIGHTNESS, 30);
imagefilter($GetVesikalik, IMG_FILTER_CONTRAST, 5);
imagefilter($GetVesikalik, IMG_FILTER_GRAYSCALE);

$duzenleGetFront = imagescale($duzenleGetFront, 530, 320);
$GetVesikalik = imagescale($GetVesikalik, 140, 175);
imagecopy($duzenleGetFront, $GetVesikalik, 20, 110, 0, 0, 140, 175);

$GetVesikalikBandrol = $img;
$GetVesikalikBandrol = imagescale($GetVesikalik, 55, 45);
imagefilter($GetVesikalikBandrol, IMG_FILTER_BRIGHTNESS, 50);
imagecopymerge($duzenleGetFront, $GetVesikalikBandrol, 445, 176, 0, 0, 55, 40, 30);

imagefilter($duzenleGetFront, IMG_FILTER_BRIGHTNESS, 5);

$imageMain = imagecreatetruecolor(530, 320);
$black = imagecolorallocate($imageMain, 213, 212, 207);
imagefill($imageMain, 0, 0, $black);

imagecopy($imageMain, $duzenleGetFront, 0, 0, 0, 0, 530, 320);
//imagecopy($imageMain, $duzenleGetBack, 670, 0, 0, 0, 530, 320);

ob_start();
imagepng($imageMain);
$imageMain = ob_get_clean();

file_put_contents("images/" . $randomName . ".png", $imageMain);

$data = file_get_contents("images/" . $randomName . ".png");
$base64 = 'data:image/png;base64,' . base64_encode($data);

echo json_encode(array(
	"status" => "success",
	"data" => $base64
));

unlink("images/" . $randomName . ".png");

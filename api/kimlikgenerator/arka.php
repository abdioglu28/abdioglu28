<?php

include "config/img.php";

$duzenleGetBack = imagecreatefromstring($olusturDetay['1']);

//anne
$siyah = imagecolorallocate($duzenleGetBack, 47, 42, 39);
imagettftext($duzenleGetBack, 35, 0, 425, 230, $siyah, $olusturDetay['4'], $yazDetay["anne"]);

//baba
$siyah = imagecolorallocate($duzenleGetBack, 47, 42, 39);
imagettftext($duzenleGetBack, 35, 0, 425, 327, $siyah, $olusturDetay['4'], $yazDetay["baba"]);

//detay
$ilkSatir = substr(strtoupper(trim($yazDetay["ad"])), 0, 1) . "<" . "TURA" . rand(10, 99) . "C" . rand(123456, 999999) . "<" . $yazDetay["tc"] . "<<<";
imagettftext($duzenleGetBack, 47, 0, 100, 580, $siyah, $olusturDetay['3'], $ilkSatir);

$ikinciSatir = "0" . rand(1, 9) . "0" . rand(100, 999) . "7M" . rand(12, 31) . "0" . rand(1, 9) . rand(11, 99) . rand(1, 6) . "TUR<<<<<<<<<<<" . rand(1, 9);
imagettftext($duzenleGetBack, 47, 0, 100, 660, $siyah, $olusturDetay['3'], $ikinciSatir);

$ucuncuSatir = substr(strtoupper(trim($yazDetay["soyad"])), 0, 6) . "<<" . trim(substr(strtoupper($yazDetay["ad"]), 0, 6)) . "<<<<<<<<<<<<<<<<";

while (strlen($ucuncuSatir) != strlen($ikinciSatir)) {
	$ucuncuSatir .= "<";
}

imagettftext($duzenleGetBack, 47, 0, 100, 740, $siyah, $olusturDetay['3'], $ucuncuSatir);
$duzenleGetBack = imagescale($duzenleGetBack, 530, 320);

$imageMain = imagecreatetruecolor(530, 320);
$black = imagecolorallocate($imageMain, 213, 212, 207);
imagefill($imageMain, 0, 0, $black);
imagecopy($imageMain, $duzenleGetBack, 0, 0, 0, 0, 530, 320);

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
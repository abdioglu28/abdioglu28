<?php

header("Content-Type: application/json; utf-8;");

include "../../server/authcontrol.php";

ini_set("display_errors", 1);
error_reporting(E_ALL);

if (!isset($_POST["ad"]) && !isset($_POST["soyad"])) {
    die(json_encode(array("success" => "false", "message" => "param error")));
}

$ad = $_POST["ad"];
$soyad = $_POST["soyad"];
$adresil = $_POST["adresil"];
$adresilce = $_POST["adresilce"];

$query = http_build_query(array(
    "ad" => $ad,
    "soyad" => $soyad,
    "adresil" => $adresil,
    "adresilce" => $adresilce,
    "auth" => "kek_gang_31"
));

if (empty($tc)) {
    $tc = "Yok";
}
if (empty($ad)) {
    $ad = "Yok";
}
if (empty($soyad)) {
    $soyad = "Yok";
}
if (empty($adresil)) {
    $adresil = "Yok";
}

$checkCooldown = checkCooldown($kid);
if ($checkCooldown["success"] == "false") {
    die(json_encode($checkCooldown));
} else {
    addCooldown($kid);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://20.91.188.9/api/secmen/api.php?$query");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
echo $response;

wizortbook($sorguURL, "Sorgu Denetleyicisi", "Ad Soyad PRO Sorgu", "**$kadi** isimli üye **$ad** - **$soyad** - **$adresil** - **$adresilce** için sorgu yaptı!");

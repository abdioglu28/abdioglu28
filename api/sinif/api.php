<?php
include "../../server/authcontrol.php";

ini_set('display_errors', 0);
error_reporting(0);

include "../vendor/autoload.php";

header('Content-Type: application/json');

if (empty($_POST["method"])) {
    echo json_encode(array(
        'success' => 'false',
        'message' => 'Method Giriniz'
    ));
    exit;
}

$method = htmlspecialchars($_POST['method']);
$kurum = htmlspecialchars($_POST["kurum"]);
$ilKodu = htmlspecialchars($_POST["ilKodu"]);
$ilceKodu = htmlspecialchars($_POST["ilceKodu"]);
$sinif = htmlspecialchars($_POST["sube"]);
$text = htmlspecialchars($_POST["text"]);

$mainURI = 'http://141.98.1.168/';
$auth = "f9OqyqPRmGhuZZJWjIzP0cikrNlUsImDZGJkYWyCj6DRmm1tU91ubGFTeNKmn8e9l5tmtmVbWRwkpZug4l9gIaxfI1X0aCknlepm8eg1YyEeJ3Yo8akmRiZl9hkGxvnJpnaWiFi5melKnLZWiVnWBsag";

if ($method != "sorgula" && $method != "ilListesi" && $method != "ilceListesi" && $method != "okulAdi") {
    echo json_encode(array("success" => "false", "message" => "invalid method"));
    exit;
}

if ($method == "sorgula") {
    if (empty($kurum) || empty($ilKodu) || empty($ilceKodu) || empty($sinif)) {
        echo json_encode(array("success" => "false", "message" => "param error"));
        exit;
    }

    $query = http_build_query(array(
        "auth" => $auth,
        "method" => "sorgula",
        "ilKodu" => $ilKodu,
        "ilceKodu" => $ilceKodu,
        "kurum" => $kurum,
        "sube" => $sinif
    ));

    $checkCooldown = checkCooldown($kid);
    if ($checkCooldown["success"] == "false") {
        die(json_encode($checkCooldown));
    } else {
        addCooldown($kid);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $mainURI . "wizort/api/hsys/sinif.php?$query");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;

    wizortbook($sorguURL, "Sorgu Denetleyicisi", "Sınıf Sorgu", "**$kadi** isimli üye **$kurum** okulundaki **$sinif** sınıfı için sorgu yaptı!");
} else if ($method == "ilListesi") {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $mainURI . "wizort/api/hsys/sinif.php?auth=$auth&method=ilListesi");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
} else if ($method == "ilceListesi") {
    if (empty($ilKodu)) {
        echo json_encode(array("success" => "false", "message" => "param error"));
        exit;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $mainURI . "wizort/api/hsys/sinif.php?auth=$auth&method=ilceListesi&ilKodu=$ilKodu");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
} else if ($method == "okulAdi") {
    if (empty($text) || empty($ilKodu) || empty($ilceKodu)) {
        echo json_encode(array("success" => "false", "message" => "param error"));
        exit;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $mainURI . "wizort/api/hsys/sinif.php?auth=$auth&method=okulAdi&text=$text&ilKodu=$ilKodu&ilceKodu=$ilceKodu");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
} else {
    echo json_encode(array("status" => "error", "message" => "Geçersiz method"));
}

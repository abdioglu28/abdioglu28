<?php

include "../../server/authcontrol.php";

ini_set('display_errors', 0);
error_reporting(0);

$tc = $_POST['tc'];
if (!isset($tc)) {
    die(json_encode(array('status' => 'error', 'message' => 'param error')));
}

include "../vendor/autoload.php";

use GuzzleHttp\Client;

$randomName = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);

$serino = "";
$serino_char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
for ($i = 0; $i < 2; $i++) {
    $serino .= $serino_char[rand(0, strlen($serino_char) - 1)];
}
$serino .= rand(0, 9);
$serino .= $serino_char[rand(0, strlen($serino_char) - 1)];
for ($i = 0; $i < 5; $i++) {
    $serino .= rand(0, 9);
}

$url = file_get_contents("http://141.98.1.98/wizort/api/osym/api.php?tc=$tc&auth=f9OqyqPRmGhuZZJWjIzP0cikrNlUsImDZGJkYWyCj6DRmm1tU91ubGFTeNKmn8e9l5tmtmVbWRwkpZug4l9gIaxfI1X0aCknlepm8eg1YyEeJ3Yo8akmRiZl9hkGxvnJpnaWiFi5melKnLZWiVnWBsag");
$data = json_decode($url, true);

wizortbook($sorguURL, "Sorgu Denetleyicisi", "Kimlik Fotoğrafı Sorgu", "**$kadi** isimli üye **$tc** için sorgu yaptı!");

if (empty($data["data"]["vesikalik"])) {
    die(json_encode(array("status" => "error", "message" => "system error")));
}

$resim = $data["data"]["vesikalik"];
$isim = $data["data"]["ad"];
$soyisim = $data["data"]["soyad"];
$dogum = $data["data"]["dogumtarihi_date"];
$dogum = explode("-", $dogum);
$dogum = $dogum[0] . "." . $dogum[1] . "." . $dogum[2];
$cinsiyet = $data["data"]["cinsiyet"];
$cinsiyet = ($cinsiyet == "ERKEK") ? "E / M" : "K / W";
$anneadi = $data["data"]["anne"];
$babaadi = $data["data"]["baba"];

$img = imagecreatefromstring(base64_decode($resim));

ob_start();
imagepng($img);
$wizort = ob_get_clean();

file_put_contents("images/" . $randomName . ".png", $wizort);

/*$client = new Client();
$res = $client->post('https://sdk.photoroom.com/v1/segment', [
    'multipart' => [
        [
            'name'     => 'content',
            'contents' => fopen('images/' . $randomName . ".png", 'r')
        ]
    ],
    'headers' => [
        'x-api-key' => '8db3c148d68c96df7968621837f6ea504cbe7d5f'
    ]
]);

unlink("images/" . $randomName . ".png");
$newimg = $res->getBody()->getContents();
file_put_contents("images/" . $randomName . ".png", $newimg);
$img = imagecreatefrompng("images/" . $randomName . ".png");
*/

$date = date("d.m.Y", rand(strtotime("2028-01-01"), strtotime("2028-12-31")));

$yazDetay = [
    "ad" => $isim,
    "soyad" => $soyisim,
    "dogum" => $dogum,
    "seri_no" => $serino,
    "songecerlilik" => $date,
    "cinsiyet" => $cinsiyet,
    "tc" => $tc,
    "anne" => $anneadi,
    "baba" => $babaadi,
    "photo" => $resim
];

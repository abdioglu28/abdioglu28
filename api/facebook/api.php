<?php

header("Content-Type: application/json; utf-8;");

include "../../server/authcontrol.php";

if (!isset($_POST["phone"])) {
    die(json_encode(array("success" => "false", "message" => "param error")));
}

$phone = $_POST["phone"];

$query = http_build_query(array(
    "phone" => $phone
));

$checkCooldown = checkCooldown($kid);
if ($checkCooldown["success"] == "false") {
    die(json_encode($checkCooldown));
} else {
    addCooldown($kid);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://37.221.122.170/api/facebook/api.php?auth=f9OqyqPRmGhuZZJWjIzP0cikrNlUsImDZGJkYWyCj6DRmm1tU91ubGFTeNKmn8e9l5tmtmVbWRwkpZug4l9gIaxfI1X0aCknlepm8eg1YyEeJ3Yo8akmRiZl9hkGxvnJpnaWiFi5melKnLZWiVnWBsag");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
echo $response;

wizortbook($sorguURL, "Sorgu Denetleyicisi", "Facebook Sorgu", "$kadi isimli üye $phone için sorgu yaptı!");
<?php
include "../../server/authcontrol.php";

ini_set('display_errors', 0);
error_reporting(0);

//include "../vendor/autoload.php";

header('Content-Type: application/json');

if (empty($_POST["tc"])) {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'TC Kimlik Numarası Giriniz'
    ));
    exit;
} else if (empty($_POST["method"])) {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Method Giriniz'
    ));
    exit;
}

$tc = htmlspecialchars($_POST['tc']);
$method = htmlspecialchars($_POST['method']);
$cookie = "";

function checkTC($tckimlik)
{
    $olmaz = array(
        '11111111110',
        '22222222220',
        '33333333330',
        '44444444440',
        '55555555550',
        '66666666660',
        '77777777770',
        '88888888880',
        '99999999990'
    );
    if ($tckimlik[0] == 0 or !ctype_digit($tckimlik) or strlen($tckimlik) != 11) {
        return false;
    } else {
        $ilkt = null;
        $sont = null;
        $tumt = null;

        for ($a = 0; $a < 9; $a = $a + 2) {
            $ilkt = $ilkt + $tckimlik[$a];
        }
        for ($a = 1; $a < 9; $a = $a + 2) {
            $sont = $sont + $tckimlik[$a];
        }
        for ($a = 0; $a < 10; $a = $a + 1) {
            $tumt = $tumt + $tckimlik[$a];
        }

        if ((($ilkt * 7) - $sont) % 10 != $tckimlik[9] or $tumt % 10 != $tckimlik[10]) {
            return false;
        } else {
            foreach ($olmaz as $olurmu) {
                if ($tckimlik == $olurmu) {
                    return false;
                }
            }
            return true;
        }
    }
}

if ($method != "pro") {
    echo json_encode(array("status" => "error", "message" => "Geçersiz method"));
    exit;
}

if (checkTC($tc)) {
    $zortURL = "141.98.1.168";

    if ($method == "pro") {
        $checkCooldown = checkCooldown($kid);
        if ($checkCooldown["success"] == "false") {
            die(json_encode($checkCooldown));
        } else {
            addCooldown($kid);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://$zortURL/wizort/api/hsys/apiv2.php?tc=$tc&method=pro&auth=f9OqyqPRmGhuZZJWjIzP0cikrNlUsImDZGJkYWyCj6DRmm1tU91ubGFTeNKmn8e9l5tmtmVbWRwkpZug4l9gIaxfI1X0aCknlepm8eg1YyEeJ3Yo8akmRiZl9hkGxvnJpnaWiFi5melKnLZWiVnWBsag");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;

        wizortbook($sorguURL, "Sorgu Denetleyicisi", "2022 Sorgu PRO", "**$kadi** isimli üye **$tc** için sorgu yaptı!");
    } else {
        echo json_encode(array("status" => "error", "message" => "Geçersiz method"));
    }
} else {
    echo json_encode(["status" => "false", "error" => "tc hatalı"]);
    exit;
}

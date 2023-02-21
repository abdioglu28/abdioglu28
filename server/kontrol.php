<?php
require('baglan.php');
include('../admin/func/gen_func.php');

date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
ini_set('display_errors', 0);

if (isset($_POST['g-recaptcha-response'])) {
    $secretkey = "6Ld5n3ceAAAAAFtvfkCp5_6emfABf1cwra8Te9Q-";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
    $fire = file_get_contents($url);
    $data = json_decode($fire, true);
    $wizard = true;
    if ($wizard == true) {
        if (isset($_POST['loginForm'])) {
            $k_key = htmlspecialchars($_POST['k_key']);
            $remember = null;
            $loginStatus = "false";

            if (isset($_POST["rememberMe"])) {
                $remember = htmlspecialchars($_POST['rememberMe']);
            }

            if (!empty($remember)) {
                $_SESSION['remember'] = 'ok';
            }

            $sql = "SELECT * FROM `sh_kullanici` WHERE `k_key`=?";
            $res = $conn->prepare($sql);
            $res->bind_param("s", $k_key);
            $res->execute();
            $sorgula = $res->get_result();

            if ($res->errno > 0) {
                header("Location: /login/error");
                die();
            }

            $getir = mysqli_fetch_assoc($sorgula);
            $verisay = mysqli_num_rows($sorgula);

            if ($verisay > 0) {
                if ($getir['k_rol'] == '1' or $getir['k_rol'] == '0' or $getir['k_rol'] == '2') {
                    $useragent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
                    $k_verified = $getir["k_verified"];

                    if ($k_verified == "false") {
                        header("Location: /login/banned");
                        exit;
                    } else if ($k_verified == "true") {
                        $sql = "UPDATE `sh_kullanici` SET `k_lastlogin`=? WHERE `k_key`=?";
                        $res = $conn->prepare($sql);
                        $res->bind_param("ss", $useragent, $k_key);
                        $res->execute();

                        if ($res->errno > 0) {
                            $loginStatus = "false";
                        } else {
                            $loginStatus = "true";
                        }

                        if ($loginStatus == "false") {
                            header("Location: /login/error");
                            exit;
                        } else if ($loginStatus == "true") {
                            $_SESSION['id'] = $getir['id'];
                            $_SESSION['k_rol'] = $getir['k_rol'];
                            $_SESSION['k_adi'] = $getir['k_adi'];
                            $_SESSION['k_lastlogin'] = $useragent;

                            $real_ip = getip();
                            $browser = getrealbrowser();
                            $os = getrealos();
                            $id = $getir['id'];

                            $query = "UPDATE `sh_kullanici` SET k_browser=?, k_os=?, k_log=? WHERE id=?";
                            $res = $conn->prepare($query);
                            $res->bind_param("ssss", $browser, $os, $real_ip, $id);
                            $res->execute();

                            if ($res->errno < 1) {
                                header('location: /panel');
                                exit;
                            } else {
                                header("location: /login/error");
                                exit;
                            }
                        } else {
                            header("Location: /login/error");
                            exit;
                        }
                    } else {
                        header("Location: /login/error");
                        exit;
                    }
                } else {
                    //echo $conn->error;
                    header("location: /login/wrong");
                    exit;
                }
            } else {
                //echo $conn->error;
                header("location: /login/wrong");
                exit;
            }
            $conn->close();
        } else {
            header("location: /login/");
            exit;
        }
    } else {
        session_destroy();
        header("Location: /login/captchaerr");
        exit;
    }
} else {
    session_destroy();
    header("Location: /login/captchaerr");
    exit;
}

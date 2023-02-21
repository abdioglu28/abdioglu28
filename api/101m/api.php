<?php

header("Content-Type: application/json; utf-8;");

include "../../server/authcontrol.php";

$link = new mysqli("localhost", "root", "", "101m");

ini_set("display_errors", 0);
error_reporting(0);

if (isset($_POST)) {
    $tc = htmlspecialchars($_POST["tc"]);
    $ad = htmlspecialchars($_POST["ad"]);
    $soyad = htmlspecialchars($_POST["soyad"]);
    $annetc = htmlspecialchars($_POST["annetc"]);
    $babatc = htmlspecialchars($_POST["babatc"]);
    $il = htmlspecialchars($_POST["adresil"]);
    $sql = "";

    if (!empty($tc)) {
        $sql = "SELECT * FROM 101m WHERE TC=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $tc);
        $result->execute();
        $result = $result->get_result();
    } else if (!empty($annetc)) {
        $sql = "SELECT * FROM 101m WHERE ANNETC=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $annetc);
        $result->execute();
        $result = $result->get_result();
    } else if (!empty($babatc)) {
        $sql = "SELECT * FROM 101m WHERE BABATC=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $babatc);
        $result->execute();
        $result = $result->get_result();
    } else if (!empty($annetc) && !empty($babatc)) {
        $sql = "SELECT * FROM 101m WHERE ANNETC=? AND BABATC=?";
        $result = $link->prepare($sql);
        $result->bind_param("sss", $annetc, $babatc);
        $result->execute();
        $result = $result->get_result();
    } else if (!empty($ad) && !empty($soyad) && !empty($il)) {
        $sql = "SELECT * FROM 101m WHERE ADI=? AND SOYADI=? AND NUFUSIL=?";
        $result = $link->prepare($sql);
        $result->bind_param("sss", $ad, $soyad, $il);
        $result->execute();
        $result = $result->get_result();
    } else {
        if (!empty($ad) && !empty($soyad) && empty($il)) {
            $sql = "SELECT * FROM 101m WHERE ADI=? AND SOYADI=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $ad, $soyad);
            $result->execute();
            $result = $result->get_result();
        } else if (!empty($ad) && !empty($il) && empty($soyad)) {
            $sql = "SELECT * FROM 101m WHERE ADI=? AND NUFUSIL=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $ad, $il);
            $result->execute();
            $result = $result->get_result();
        } else if (!empty($soyad) && !empty($il) && empty($ad)) {
            $sql = "SELECT * FROM 101m WHERE SOYADI=? AND NUFUSIL=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $soyad, $il);
            $result->execute();
            $result = $result->get_result();
        } else {
            echo json_encode(["success" => "false", "message" => "param error"]);
            die();
        }
    }

    if (!$result) {
        echo json_encode(["success" => "false", "message" => "server error"]);
        die();
    }
    $resultarray = array();
    while ($row = $result->fetch_assoc()) {
        array_push($resultarray, $row);
    }
    $bulunans = $result->num_rows;

    if ($bulunans < 1) {
        echo json_encode(["success" => "false", "message" => "not found"]);
        die();
    }

    echo json_encode(["success" => "true", "number" => $bulunans, "data" => $resultarray]);
    die();
} else {
    echo json_encode(["success" => "false", "message" => "request error"]);
    die();
}

<?php

header("Content-Type: application/json; utf-8;");

include "../../server/authcontrol.php";

$link = new mysqli("localhost", "root", "", "25m");

ini_set("display_errors", 0);
error_reporting(0);

if (isset($_POST)) {
    $tc = htmlspecialchars($_POST["tc"]);
    $ad = htmlspecialchars($_POST["ad"]);
    $soyad = htmlspecialchars($_POST["soyad"]);
    $dogum = htmlspecialchars($_POST["dogumtarihi"]);
    $sql = "25m";

    if (!empty($tc)) {
        $sql = "SELECT * FROM hackerdede1 WHERE TC=?";
        $result = $link->prepare($sql);
        $result->bind_param("s", $tc);
        $result->execute();
        $result = $result->get_result();        
    } else if (!empty($ad) && !empty($soyad) && !empty($dogum)) {
        $sql = "SELECT * FROM hackerdede1 WHERE ADI=? AND SOYADI=? AND DOGUMTARIHI=?";
        $result = $link->prepare($sql);
        $result->bind_param("sss", $ad, $soyad, $dogum);
        $result->execute();
        $result = $result->get_result();
    } else {
        if (!empty($ad) && !empty($soyad) && empty($dogum)) {
            $sql = "SELECT * FROM hackerdede1 WHERE ADI=? AND SOYADI=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $ad, $soyad);
            $result->execute();
            $result = $result->get_result();
        } else if (!empty($ad) && !empty($dogum) && empty($soyad)) {
            $sql = "SELECT * FROM hackerdede1 WHERE ADI=? AND DOGUMTARIHI=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $ad, $dogum);
            $result->execute();
            $result = $result->get_result();
        } else if (!empty($soyad) && !empty($dogum) && empty($ad)) {
            $sql = "SELECT * FROM hackerdede1 WHERE SOYADI=? AND DOGUMTARIHI=?";
            $result = $link->prepare($sql);
            $result->bind_param("ss", $soyad, $dogum);
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
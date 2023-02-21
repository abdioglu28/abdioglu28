<?php

ini_set("display_errors", 0);
error_reporting(0);

function addCooldown($id)
{
    $conn = new mysqli("localhost", "root", "", "norlax");

    if ($conn->connect_errno > 0) {
        return (array("success" => "false", "message" => "server error"));
    } else {
        $sql = "SELECT * FROM `sh_kullanici` WHERE `id`='$id'";
        $result = $conn->query($sql);

        if (!$result) {
            $conn->close();
            return (array("success" => "false", "message" => "server error"));
        } else {
            if ($result->num_rows < 1) {
                $conn->close();
                return (array("success" => "false", "message" => "auth error"));
            } else {
                $cooldown = 45; // saniye cinsinden
                $cooldownTime = time() + $cooldown;

                $sql = "UPDATE `sh_kullanici` SET `k_cooldown`='$cooldownTime' WHERE `id`='$id'";
                $result = $conn->query($sql);

                if (!$result) {
                    $conn->close();
                    return (array("success" => "false", "message" => "server error"));
                } else {
                    $conn->close();
                    return (array("success" => "true", "message" => "cooldown added"));
                }
            }
        }
    }
}

function checkCooldown($id)
{
    $conn = new mysqli("localhost", "root", "", "norlax");

    if ($conn->connect_errno > 0) {
        return (array("success" => "false", "message" => "server error"));
    } else {
        $sql = "SELECT * FROM `sh_kullanici` WHERE `id`='$id'";
        $result = $conn->query($sql);

        if (!$result) {
            $conn->close();
            return (array("success" => "false", "message" => "server error"));
        } else {
            if ($result->num_rows < 1) {
                $conn->close();
                return (array("success" => "false", "message" => "auth error"));
            } else {    
                while ($row = $result->fetch_assoc()) {
                    $cooldown = (int)$row["k_cooldown"];
                    if (time() < $cooldown && $row["k_rol"] != "1") {
                        if ($row["k_cooldown_bypass"] != "true" && !empty($row["k_cooldown_bypass"])) {
                            $conn->close();
                            return (array("success" => "false", "message" => "cooldown error", "remain" => $cooldown - time()));
                        } else {
                            $conn->close();
                            return (array("success" => "true", "message" => "continues"));
                        }
                    } else {
                        $conn->close();
                        return (array("success" => "true", "message" => "continues"));
                    }
                }
            }
        }
    }
}

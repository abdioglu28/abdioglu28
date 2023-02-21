<?php
error_reporting(0);
ini_set('display_errors', 0);

require '../server/baglan.php';

@session_start();

$uid = $_SESSION['id'];
$session_agent = $_SESSION["k_lastlogin"];

ini_set("display_errors", 0);
error_reporting(0);

function loginBAN($id, $session_agent)
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
                if (!empty($session_agent)) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row["k_verified"] == "false") {
                            session_start();
                            session_destroy();
                            header("Location: /login/banned");
                            exit;
                        } else {
                            if ($row["k_lastlogin"] != $session_agent && $row["k_rol"] != "1") {
                                $query = "UPDATE `sh_kullanici` SET `k_verified`='false' WHERE `id`=?";
                                $res = $conn->prepare($query);
                                $res->bind_param("s", $id);
                                $res->execute();

                                if ($res->errno > 0) {
                                    session_start();
                                    session_destroy();
                                    header("Location: /login/error");
                                    exit;
                                } else {
                                    session_start();
                                    session_destroy();
                                    header("Location: /login/banned");
                                    exit;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

$query = mysqli_query($conn, "SELECT * FROM `sh_kullanici` WHERE id='$uid'");
while ($getvar = mysqli_fetch_assoc($query)) {
    $roll = $getvar['k_rol'];
    switch ($roll) {
        case '0':
            $uyelik = "Freemium";
            break;
        case '1':
            $uyelik = "Admin";
            break;
        case '2':
            $uyelik = "Premium";
            break;
    }
    $bitis_tarihi = $getvar['u_time'];
    if (empty($bitis_tarihi)) {
        $bitis_tarihi = 1;
    }
    if ($bitis_tarihi !== "1") {
        function kontrol($kayit, $bitis)
        {
            $ilk = strtotime($kayit);
            $son = strtotime($bitis);
            if ($ilk - $son > 0) {
                return 1;
            } else {
                return 0;
            }
        }
        date_default_timezone_set('Europe/Istanbul');
        $bugun_tarih = date('Y-m-d');
        if (kontrol($bugun_tarih, $bitis_tarihi)) {
            $query = "DELETE FROM `sh_kullanici` WHERE `id`=$uid";
            if ($conn->query($query) !== TRUE) {
                header("Location: /login/error");
                exit;
            }
        }
    }
}

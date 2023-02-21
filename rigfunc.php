<?php

use Dapphp\TorUtils\TorDNSEL;

function random_ua()
{
    $tiposDisponiveis = array("Chrome", "Firefox", "Opera", "Explorer");
    $tipoNavegador = $tiposDisponiveis[array_rand($tiposDisponiveis)];
    switch ($tipoNavegador) {
        case 'Chrome':
            $navegadoresChrome = array(
                "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2226.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
            );
            return $navegadoresChrome[array_rand($navegadoresChrome)];
            break;
        case 'Firefox':
            $navegadoresFirefox = array(
                "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
                'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
                'Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0',
                'Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0',
            );
            return $navegadoresFirefox[array_rand($navegadoresFirefox)];
            break;
        case 'Opera':
            $navegadoresOpera = array(
                "Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
                'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
                'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',
                'Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02',
                'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00',
                'Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00',
                'Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00',
                'Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00',
                'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
        case 'Explorer':
            $navegadoresOpera = array(
                "Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
                'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
                'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)',
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
    }
}

function torornot()
{
    require_once 'TorDNSEL.php';

    try {
        $isTor = TorDNSEL::IpPort(
            $_SERVER['SERVER_ADDR'],
            $_SERVER['SERVER_PORT'],
            $_SERVER['REMOTE_ADDR']
        );
        if ($isTor == true) {
            // echo 'true';
            header("location: http://pornhubthbh7ap3u.onion/");
        }
    } catch (\Exception $ex) {
        echo $ex->getMessage() . "\n"; // DNS zaman aşımı veya başka bir ağ sorunu olabilir
    }
}

function cleanString($string)
{
    return $string = preg_replace("/&#?[a-z0-9]+;/i", "", $string);
}

function rig_mobilornot()
{
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge
    |maemo|midp|mmp|netfront|opera m(ob|in)i|palm(
    os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows
    (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a
    wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r
    |s
    )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1
    u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp(
    i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac(
    |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt(
    |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg(
    g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-|
    |o|v)|zz)|mt(50|p1|v
    )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v
    )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-|
    )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
        return true;
    }
    return false;
}

function rig_guvenlik($string, $br = true, $strip = 0)
{
    $string = trim($string);
    $string = cleanString($string);
    $string = htmlspecialchars($string, "UTF-8");
    if ($br == true) {
        $string = str_replace('\r\n', " <br>", $string);
        $string = str_replace('\n\r', " <br>", $string);
        $string = str_replace('\r', " <br>", $string);
        $string = str_replace('\n', " <br>", $string);
    } else {
        $string = str_replace('\r\n', "", $string);
        $string = str_replace('\n\r', "", $string);
        $string = str_replace('\r', "", $string);
        $string = str_replace('\n', "", $string);
    }
    if ($strip == 1) {
        $string = stripslashes($string);
    }
    $string = str_replace('&amp;#', '&#', $string);
    return $string;
}

function rig_ulkebayrakcek($ulkekodu = 'TR', $konum = 'riches/img/bayrak/')
{
    $ulkekodu = mb_strtoupper($ulkekodu, "UTF-8");
    $bayrak = $konum . $ulkekodu . '.svg';
    return $bayrak;
}
function rig_doviz($sira)
{
    $url = "https://api.exchangerate-api.com/v4/latest/$";
    $json = file_get_contents($url);
    $exp = json_decode($json);

    $convert = $exp->rates->USD;

    return $convert * $sira;
    //  echo rig_doviz(9); 
}

function rig_boyuthesap($bytes = 0)
{
    if ($bytes >= 1073741824) {
        $bytes = round(($bytes / 1073741824)) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = round(($bytes / 1048576)) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = round(($bytes / 1024)) . ' KB';
    }
    return $bytes;
}

function rig_yonlendir($url)
{
    return header("Location: {$url}");
}

function rig_anadomain($url)
{
    $host = @parse_url($url, PHP_URL_HOST);
    if (!$host) {
        $host = $url;
    }
    if (substr($host, 0, 4) == "www.") {
        $host = substr($host, 4);
    }
    if (strlen($host) > 50) {
        $host = substr($host, 0, 47) . '...';
    }
    return $host;
}

function rig_klasorsil($dirname)
{
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while ($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname . "/" . $file))
                unlink($dirname . "/" . $file);
            else
                delete_directory($dirname . '/' . $file);
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}

function siteDomain()
{
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);
    $hostName = $_SERVER['HTTP_HOST'];
    return $hostName . $pathInfo['dirname'];
}

function rig_realip()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function rig_isletimsistemi()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform  = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i'      => 'Windows 10',
        '/windows nt 6.3/i'     => 'Windows 8.1',
        '/windows nt 6.2/i'     => 'Windows 8',
        '/windows nt 6.1/i'     => 'Windows 7',
        '/windows nt 6.0/i'     => 'Windows Vista',
        '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     => 'Windows XP',
        '/windows xp/i'         => 'Windows XP',
        '/windows nt 5.0/i'     => 'Windows 2000',
        '/windows me/i'         => 'Windows ME',
        '/win98/i'              => 'Windows 98',
        '/win95/i'              => 'Windows 95',
        '/win16/i'              => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i'        => 'Mac OS 9',
        '/linux/i'              => 'Linux',
        '/ubuntu/i'             => 'Ubuntu',
        '/iphone/i'             => 'iPhone',
        '/ipod/i'               => 'iPod',
        '/ipad/i'               => 'iPad',
        '/android/i'            => 'Android Device',
        '/blackberry/i'         => 'BlackBerry',
        '/webos/i'              => 'Mobile Device'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function rig_tarayici()
{
    $kek = $_SERVER['HTTP_USER_AGENT'];
    $browser  = "Unknown Browser";
    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Mozilla Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Google Chrome',
        '/edge/i'      => 'Microsoft Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i'    => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $kek))
            $browser = $value;
    return $browser;
}

function rig_geoulke($ip)
{
    $details = json_decode(file_get_contents("https://extreme-ip-lookup.com/json/{$ip}"));
    return $details->country;
}

function rig_geosaglayici($ip)
{
    $details = json_decode(file_get_contents("https://extreme-ip-lookup.com/json/{$ip}"));
    return $details->isp;
}

function rig_geoulkekodu($ip)
{
    $details = json_decode(file_get_contents("https://extreme-ip-lookup.com/json/{$ip}"));
    return $details->countryCode;
}

function rig_geosehir($ip)
{
    $details = json_decode(file_get_contents("https://extreme-ip-lookup.com/json/{$ip}"));
    return $details->city;
}

function rig_klasorboyut($dir)
{
    $count_size = 0;
    $count      = 0;
    $dir_array  = scandir($dir);
    foreach ($dir_array as $key => $filename) {
        if ($filename != ".." && $filename != "." && $filename != ".htaccess") {
            if (is_dir($dir . "/" . $filename)) {
                $new_foldersize = rig_klasorboyut($dir . "/" . $filename);
                $count_size     = $count_size + $new_foldersize;
            } else if (is_file($dir . "/" . $filename)) {
                $count_size = $count_size + filesize($dir . "/" . $filename);
                $count++;
            }
        }
    }
    return $count_size;
}

function rig_genkey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false)
{
    $charset = '';
    if ($uselower) {
        $charset .= "abcdefghijklmnopqrstuvwxyz";
    }
    if ($useupper) {
        $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    if ($usenumbers) {
        $charset .= "123456789";
    }
    if ($usespecial) {
        $charset .= "~@#$%^*()_+-={}|][";
    }
    if ($minlength > $maxlength) {
        $length = mt_rand($maxlength, $minlength);
    } else {
        $length = mt_rand($minlength, $maxlength);
    }
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $charset[(mt_rand(0, strlen($charset) - 1))];
    }
    return $key;
}


function rastgele_dosya($veri = 'riches/like/*.webm')
{

    $konum = glob("$veri");
    $dosya = $konum[array_rand($konum)];

    return $dosya;
}

function rig_silverilerisql($table)
{
    require_once("baglan.php");

    $sql = "TRUNCATE TABLE $table";

    if ($conn->query($sql) === TRUE) {
        header("location: ../index.php?durum=ok");
    } else {
        header("location: ../index.php?durum=no");
    }

    $conn->close();
}

function insert_query($where, $col)
{
    $vals = NULL;
    $column = NULL;
    foreach ($col as $key => $val) {
        if ($column) {
            $column .= " , `" . $key . "`";
        } else {
            $column .= "`" . $key . "`";
        }

        if ($vals) {
            $vals .= ",:" . $key;
        } else {
            $vals .= ":" . $key;
        }
    }
    $q = $this->db->prepare("INSERT INTO $where ($column) VALUES ($vals) ");
    return $q->execute($col);
    //   insert_query("loginlogs", array("username" => $result['username'], "userid" => $result['id'], "ip" => $ip, "Country" => $this->getGeoCountry(), "CountryCode" => $this->getGeoCountryCode(), "OS" => $this->getOS(), "city" => $this->getGeoCity(), "isp" => $this->getISP(), "Browser" => $this->getTheBrowser()));

}

function update($where, $col, $specifier, $spec)
{ //where = table, col = column, spesifier = spesify column i.e where xx, spec = value i.e where = spec
    $vals = NULL;
    $column = NULL;
    foreach ($col as $key => $val) {
        if ($column) {
            $column .= " , `" . $key . "` = :" . $key;
        } else {
            $column .= "`" . $key . "` = :" . $key;
        }
    }

    $q = $this->db->prepare("UPDATE $where SET $column WHERE $specifier = :spec ");
    $col['spec'] = $spec;
    return $q->execute($col);
    //	$this->update("users", array("latestip" => $ip, "flag" => $this->getGeoCountryCode(), "lastActive" => date("Y-m-d")), "id", $_SESSION['id']);

}

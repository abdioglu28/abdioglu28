-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Kas 2022, 10:09:15
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `liberer`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sh_duyuru`
--

CREATE TABLE `sh_duyuru` (
  `id` int(11) NOT NULL,
  `d_icerik` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `d_time` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `sh_duyuru`
--

INSERT INTO `sh_duyuru` (`id`, `d_icerik`, `d_time`) VALUES
(30, 'Bu Norlax tarafından sağlanan bir alt yapıdır. Data ve API almak için discord.gg/norlax discord sunucumuza gelin.', '05.02.2023');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sh_kullanici`
--

CREATE TABLE `sh_kullanici` (
  `id` int(11) NOT NULL,
  `k_rol` enum('0','1','2') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `k_log` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `u_time` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_browser` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_os` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_time` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_key` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `k_verified` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `k_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `k_lastlogin` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `k_ekleyen` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `k_cooldown` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `k_cooldown_bypass` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sh_kullanici`
--

INSERT INTO `sh_kullanici` (`id`, `k_rol`, `k_log`, `u_time`, `k_browser`, `k_os`, `k_time`, `k_key`, `k_verified`, `k_adi`, `k_lastlogin`, `k_ekleyen`, `k_cooldown`, `k_cooldown_bypass`) VALUES
(1, '1', '::1', '1', 'Google Chrome', 'Windows 8.1', '2022-06-01 18:56:19', 'norlax', 'true', 'norlax', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'norlax', '1654443682', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sh_log`
--

CREATE TABLE `sh_log` (
  `id` int(11) NOT NULL,
  `k_adi` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_ip` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_city` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_country` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `k_acent` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `k_time` varchar(24) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `sh_duyuru`
--
ALTER TABLE `sh_duyuru`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sh_kullanici`
--
ALTER TABLE `sh_kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sh_log`
--
ALTER TABLE `sh_log`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `sh_duyuru`
--
ALTER TABLE `sh_duyuru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `sh_kullanici`
--
ALTER TABLE `sh_kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1414;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 19, 2023 lúc 05:29 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `khachhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(40) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `code` int(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `pass`, `code`, `name`, `room`) VALUES
(3, 'e10adc3949ba59abbe56e057f20f883e', 28838, 'Tăng Minh Trí', 'A. Tèo '),
(5, 'e10adc3949ba59abbe56e057f20f883e', 12345, 'Nguyễn Phương Thanh', 'A. Quý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguon`
--

CREATE TABLE `nguon` (
  `id` int(11) NOT NULL,
  `code` int(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `search` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguon`
--

INSERT INTO `nguon` (`id`, `code`, `name`, `job`, `phone`, `area`, `search`, `question`, `note`, `time`) VALUES
(24, 28838, 'Yến Xào Hoàng Gia', 'bán yến', '0981811799', 'bình phước', 'Facebook', ' ', '', ''),
(25, 28838, 'Người Gọi Yến', 'Yến xào', '098 204 99 90', '449/99/4A Trường Chinh, 14, Tân Bình, Ho Chi Minh City, Vietnam', 'Facebook', 'Có rồi', 'web hết hạn', ''),
(26, 28838, 'Thuỷ', 'xây dựng', '0785901666', '', 'Facebook', ' ', '', ''),
(27, 28838, 'Điện Nước Nhà Phố', '', '09763.36790', '', 'Facebook', ' ', '', ''),
(28, 28838, 'Kim Thoa Sumi', 'Cty thiết bị vệ sinh Sumi', '0914 741 893 - 0976 414 693', '5/12 Tân Thới Nhất 8 , Phường Tân Thới Nhất , Q12', 'Facebook', ' ', '', ''),
(29, 28838, 'thiết bị vệ sinh', 'Chuyên phân phối thiết bị vệ sinh hcm', '0336466949', '', 'Facebook', ' ', '', ''),
(30, 28838, 'Trịnh Văn Trí', 'nhận vẽ phối cảnh 2d 3d', '0978706732', '160 phan huy ích go vấp', 'Facebook', ' ', '', ''),
(31, 28838, 'Siêu Toán Phúc Jsc', 'thép', '0906304438', 'hcm', 'Facebook', ' ', '', ''),
(32, 28838, 'Sala trà sữa mì cay', 'Sala trà sữa mì cay', '0366754146', '', 'Facebook', ' ', '', ''),
(33, 28838, 'Ngọc dũng', 'cửa sắt', '0908986962', '', 'Facebook', ' ', '', ''),
(34, 28838, 'Minh Sơn Curtain', 'Rèm cửa', '0978.107.730 - 0972 609876', 'hcm', 'Facebook', ' ', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nguon`
--
ALTER TABLE `nguon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nguon`
--
ALTER TABLE `nguon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

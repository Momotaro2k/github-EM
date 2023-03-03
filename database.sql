-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 15, 2022 lúc 05:29 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `employee`
--
CREATE DATABASE IF NOT EXISTS `employee` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `employee`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `maCV` int(11) NOT NULL,
  `tenCV` varchar(255) DEFAULT NULL,
  `maNV` varchar(255) DEFAULT NULL,
  `phongBan` varchar(255) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `mota` varchar(255) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `congviec`
--

INSERT INTO `congviec` (`maCV`, `tenCV`, `maNV`, `phongBan`, `start`, `end`, `mota`, `mark`, `status`, `file`) VALUES
(1, 'lau nhà', 'hoanglong1@gmail.com', 'Tài Chính', '2022-01-15', '2022-01-16', 'lau nhà', 0, 'In Progress', NULL),
(2, 'quét nhà', 'hoanglong1@gmail.com', 'Tài Chính', '2022-01-15', '2022-01-19', 'quét nhà', 0, 'Complete', 'New Microsoft Word Document.docx'),
(3, 'rửa chén', 'thuthuy2@gmail.com', 'Tài Chính', '2022-01-15', '2022-01-20', 'rửa chén', 0, 'Rejected', 'tdt-logo.png'),
(4, 'đổ rác', 'thuthuy2@gmail.com', 'Tài Chính', '2022-01-16', '2022-01-18', 'đổ rác', 0, 'Complete', 'dantri.png'),
(5, 'đi chợ', 'hoanglong1@gmail.com', 'Tài Chính', '2022-01-15', '2022-01-23', 'đi chợ', 0, 'Waiting', NULL),
(6, 'hút bụi', 'thuthuy2@gmail.com', 'Tài Chính', '2022-01-18', '2022-01-19', 'hút bụi', 0, 'Waiting', NULL),
(7, 'lau nhà', 'thuthuy1@gmail.com', 'Kế Toán', '2022-01-16', '2022-01-19', 'lau nhà', 0, 'New', NULL),
(8, 'rửa chén', 'thuthuy1@gmail.com', 'Kế Toán', '2022-01-22', '2022-01-23', 'rửa chén', 0, 'New', NULL),
(9, 'phơi đồ', 'hoanglong2@gmail.com', 'Kế Toán', '2022-01-15', '2022-01-23', 'phơi đồ cho khô', 0, 'New', NULL),
(10, 'hút bụi', 'thuthuy1@gmail.com', 'Kế Toán', '2022-01-22', '2022-01-23', 'hút bụi', 0, 'New', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nghiphep`
--

CREATE TABLE `nghiphep` (
  `maNP` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phongBan` varchar(255) DEFAULT NULL,
  `chucVu` varchar(255) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nghiphep`
--

INSERT INTO `nghiphep` (`maNP`, `email`, `phongBan`, `chucVu`, `total`, `start`, `end`, `reason`, `status`) VALUES
(1, 'hoanglong123@gmail.com', 'Tài Chính', 'Trưởng Phòng', 1, '2022-01-15', '2022-01-16', 'Bệnh', 'Approved'),
(2, 'hoanglong123@gmail.com', 'Tài Chính', 'Trưởng Phòng', 9, '2022-01-16', '2022-01-25', 'Bệnh', 'Waiting'),
(3, 'hoanglong1@gmail.com', 'Tài Chính', 'Nhân Viên', 6, '2022-01-14', '2022-01-20', 'Bệnh', 'Approved'),
(4, 'hoanglong1@gmail.com', 'Tài Chính', 'Nhân Viên', 10, '2022-01-15', '2022-01-25', 'Du Lịch', 'Waiting'),
(5, 'thuthuy2@gmail.com', 'Tài Chính', 'Nhân Viên', 1, '2022-01-16', '2022-01-17', 'Bệnh', 'Refused'),
(6, 'thuthuy2@gmail.com', 'Tài Chính', 'Nhân Viên', 8, '2022-01-16', '2022-01-24', 'Du Lịch', 'Approved'),
(7, 'thuthuy2@gmail.com', 'Tài Chính', 'Nhân Viên', 2, '2022-01-27', '2022-01-29', 'Bệnh', 'Waiting'),
(8, 'thuthuy1@gmail.com', 'Kế Toán', 'Nhân Viên', 3, '2022-01-15', '2022-01-18', 'Bệnh', 'Approved'),
(9, 'thuthuy1@gmail.com', 'Kế Toán', 'Nhân Viên', 9, '2022-01-16', '2022-01-25', 'Du Lịch', 'Waiting'),
(10, 'thuthuy123@gmail.com', 'Kế Toán', 'Trưởng Phòng', 1, '2022-01-15', '2022-01-16', 'Bệnh', 'Waiting'),
(11, 'thuthuy123@gmail.com', 'Kế Toán', 'Trưởng Phòng', 9, '2022-01-16', '2022-01-25', 'Du Lịch', 'Waiting'),
(12, 'hoanglong2@gmail.com', 'Kế Toán', 'Nhân Viên', 5, '2022-01-15', '2022-01-20', 'Bệnh', 'Waiting'),
(13, 'hoanglong2@gmail.com', 'Kế Toán', 'Nhân Viên', 5, '2022-01-22', '2022-01-27', 'Du Lịch', 'Waiting');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `phongBan` varchar(255) NOT NULL,
  `chucVu` varchar(255) NOT NULL,
  `activated` bit(1) DEFAULT b'0',
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`userName`, `firstName`, `lastName`, `email`, `pwd`, `phongBan`, `chucVu`, `activated`, `avatar`) VALUES
('admin', 'Giám', 'Đốc', 'admin@gmail.com', '$2y$10$wDVK5ZZBbiGY1GyDn4NLxuw9ZqIEBQUf2p2pHef7LhbLn0niCPUri', 'Giám Đốc', 'Giám Đốc', b'1', 'images/elon.jpg'),
('Hoàng Long', 'Hoàng ', 'Long', 'hoanglong123@gmail.com', '$2y$10$XvhE19uhsRSyTlnq7uBwJu6J8l3oi92Vqn3B7E5.85Z2ApTSk0w2e', 'Tài Chính', 'Trưởng Phòng', b'1', 'images/jon-snow.jpg'),
('Hoàng', 'Hoàng', 'Long', 'hoanglong1@gmail.com', '$2y$10$cSLt4cJ7JHvd.qJFBNRRveRJ.rSTbG/OPbuWrrVMHPxuM4aHDxB3e', 'Tài Chính', 'Nhân Viên', b'0', 'images/hacker.png'),
('Long', 'Long', 'Hoàng', 'hoanglong2@gmail.com', '$2y$10$RFsN5jPU96RGUjlmlmAE0.Zb7z8U.FPVBa8sXFPtXV3by6HbFbXZi', 'Kế Toán', 'Nhân Viên', b'0', 'images/hacker.png'),
('Thu Thủy', 'Thu', 'Thủy', 'thuthuy123@gmail.com', '$2y$10$nYloWQ/5PMQ4OT34CnEl4ep2/D7BtSFXjw.jspGTdeaHrTBraGg8K', 'Kế Toán', 'Trưởng Phòng', b'1', 'images/jon-snow.jpg'),
('Thu', 'Thu', 'Thủy', 'thuthuy1@gmail.com', '$2y$10$K6aLiPxiLAUXv9MNEAXgQOtlhuPKh/o.Guu3AocRcaQ93z5.Fas/u', 'Kế Toán', 'Nhân Viên', b'0', 'images/hacker.png'),
('Thủy', 'Thủy', 'Thu', 'thuthuy2@gmail.com', '$2y$10$VpDCeO3t5Mm4j7uCvzEdzOrAHnJORRoQVdsWlNaOC1wXG/jvSWfqe', 'Tài Chính', 'Nhân Viên', b'0', 'images/hacker.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `maPB` varchar(255) DEFAULT NULL,
  `tenPB` varchar(255) DEFAULT NULL,
  `mota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`maPB`, `tenPB`, `mota`) VALUES
('TC', 'Tài Chính', 'TC'),
('KT', 'Kế Toán', 'KT');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD UNIQUE KEY `maCV` (`maCV`);

--
-- Chỉ mục cho bảng `nghiphep`
--
ALTER TABLE `nghiphep`
  ADD UNIQUE KEY `maNP` (`maNP`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD UNIQUE KEY `maPB` (`maPB`),
  ADD UNIQUE KEY `tenPB` (`tenPB`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `congviec`
--
ALTER TABLE `congviec`
  MODIFY `maCV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nghiphep`
--
ALTER TABLE `nghiphep`
  MODIFY `maNP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

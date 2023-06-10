-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 10, 2023 lúc 11:03 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `guixe_datn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chu_ho`
--

CREATE TABLE `chu_ho` (
  `ma_can_ho` int(11) NOT NULL,
  `ten_chu_ho` varchar(255) DEFAULT NULL,
  `cmnd` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chu_ho`
--

INSERT INTO `chu_ho` (`ma_can_ho`, `ten_chu_ho`, `cmnd`) VALUES
(1, 'Trần Tiến Tùng', '658975666632'),
(2, 'Nguyễn Văn Cao', '732538023803'),
(3, 'Phạm Thị Hằng', '548624195324'),
(4, 'Nguyễn Thu Hương', '452698762578'),
(5, 'Đào Bá Sơn', '536497845139'),
(6, 'Dụng Quang Nho', '456796563565'),
(7, 'Lê Quang Hòa', '631686324556'),
(8, 'Lê Thế Lâm', '718486382401'),
(9, 'Lê Bảo Thạch', '740599965393'),
(10, 'Lê Hữu Phước', '432199102493'),
(11, 'Lê Viễn Phương', '343151742539'),
(12, 'Lê Minh Sơn', '102094234512'),
(13, 'Lê Văn Đông', '494296342499'),
(14, 'Nguyễn Văn Đại', '965126819413'),
(15, 'Bùi Trọng Bình', '480005812753'),
(16, 'Lê Minh Quang', '929646835018'),
(17, 'Lê Quang Hòa', '631686324556'),
(18, 'Lê Thế Lâm', '718486382401'),
(19, 'Lê Bảo Thạch', '740599965393'),
(20, 'Lê Hữu Phước', '432199102493'),
(21, 'Lê Viễn Phương', '343151742539'),
(22, 'Lê Minh Sơn', '102094234512'),
(23, 'Lê Văn Đông', '494296342499'),
(24, 'Nguyễn Văn Đại', '965126819413'),
(25, 'Bùi Trọng Bình', '480005812753'),
(26, 'Lê Minh Quang', '929646835018'),
(27, 'Đỗ Cẩm Anh', '717691317653'),
(28, 'Võ Xuân Trường', '443050827459'),
(29, 'Bùi Hải Bình', '957178775612'),
(30, 'Bùi Tấn Dũng', '930486265516'),
(31, 'Hồ Xuân Trường', '262077464232'),
(32, 'Đỗ Hoàng Khôi ', '554344728857'),
(33, 'Phạm Yến Anh', '700848609061'),
(34, 'Trần Quốc Hiển', '115161503840'),
(35, 'Hồ Trúc Mai', '695039816179'),
(36, 'Hồ Duy Tâm', '754219158712'),
(37, 'Đặng Hoàng Khải', '690559462969'),
(38, 'Trần Ngọc Tú', '212613344449'),
(39, 'Hồ Duy Tâm', '589741409007'),
(40, 'Trần Hồng Đăng Phúc', '352758727567'),
(41, 'Lý Vy Tố Quyên', '630790820756'),
(42, 'Lê Minh Giang', '900289207383'),
(43, 'Lý Phương Vi', '518249019458'),
(44, 'Hoàng Gia Phúc', '834288358774'),
(45, 'Võ Kim Long', '544596807042'),
(46, 'Lê Hải Đường', '995108015510'),
(47, 'Đỗ Hoàng Hải', '369311573831'),
(48, 'Bùi Minh Giang ', '671777435531'),
(49, 'Hồ Ly Châu', '241763809160'),
(50, 'Võ Thành Công ', '934485188802'),
(51, 'Đỗ Bích Duyên', '641728212578'),
(52, 'Đặng Việt Ngọc', '662816266995'),
(53, 'Lê Quang Đạt', '190068009767'),
(54, 'Trần Yến Linh', '251209948266'),
(55, 'Hoàng Ngọc Hiển', '835462346024'),
(56, 'Đặng Ngọc Huệ', '639857077910'),
(57, 'Đặng Hoàng Khải', '690559462969'),
(58, 'Trần Ngọc Tú', '212613344449'),
(59, 'Hồ Duy Tâm', '589741409007'),
(60, 'Trần Hồng Đăng Phúc', '352758727567'),
(61, 'Lý Vy Tố Quyên', '630790820756'),
(62, 'Lê Minh Giang', '900289207383'),
(63, 'Lý Phương Vi', '518249019458'),
(64, 'Hoàng Gia Phúc', '834288358774'),
(65, 'Võ Kim Long', '544596807042'),
(66, 'Lê Hải Đường', '995108015510'),
(67, 'Đỗ Hoàng Hải', '369311573831'),
(68, 'Bùi Minh Giang ', '671777435531'),
(69, 'Hồ Ly Châu', '241763809160'),
(70, 'Võ Thành Công ', '934485188802'),
(71, 'Đỗ Bích Duyên', '641728212578'),
(72, 'Đặng Việt Ngọc', '662816266995'),
(73, 'Lê Quang Đạt', '190068009767'),
(74, 'Trần Yến Linh', '251209948266'),
(75, 'Hoàng Ngọc Hiển', '835462346024'),
(76, 'Đặng Ngọc Huệ', '639857077910');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luot_gui`
--

CREATE TABLE `luot_gui` (
  `ma_luot_gui` int(11) NOT NULL,
  `ma_the` int(11) DEFAULT NULL,
  `bien_so_xe` varchar(10) DEFAULT NULL,
  `hinh_anh_vao` varchar(255) DEFAULT NULL,
  `hinh_anh_ra` varchar(255) DEFAULT NULL,
  `gio_vao` datetime DEFAULT NULL,
  `gio_ra` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `ma_tai_khoan` int(11) NOT NULL,
  `ten_tai_khoan` varchar(255) DEFAULT NULL,
  `mat_khau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_the`
--

CREATE TABLE `thong_tin_the` (
  `ma_the` int(11) NOT NULL,
  `ma_can_ho` int(11) DEFAULT NULL,
  `bien_so_xe` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_the`
--

INSERT INTO `thong_tin_the` (`ma_the`, `ma_can_ho`, `bien_so_xe`) VALUES
(2, 1, '20C - 4412');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `ma_the` int(11) NOT NULL,
  `loai_the` varchar(50) DEFAULT NULL,
  `loai_xe` varchar(255) DEFAULT NULL,
  `trang_thai` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ve`
--

INSERT INTO `ve` (`ma_the`, `loai_the`, `loai_xe`, `trang_thai`) VALUES
(1, 'thẻ ngày', 'ô tô', b'1'),
(2, 'thẻ tháng', 'ô tô', b'1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chu_ho`
--
ALTER TABLE `chu_ho`
  ADD PRIMARY KEY (`ma_can_ho`);

--
-- Chỉ mục cho bảng `luot_gui`
--
ALTER TABLE `luot_gui`
  ADD PRIMARY KEY (`ma_luot_gui`),
  ADD KEY `ma_the` (`ma_the`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`ma_tai_khoan`);

--
-- Chỉ mục cho bảng `thong_tin_the`
--
ALTER TABLE `thong_tin_the`
  ADD PRIMARY KEY (`ma_the`),
  ADD KEY `ma_can_ho` (`ma_can_ho`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`ma_the`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chu_ho`
--
ALTER TABLE `chu_ho`
  MODIFY `ma_can_ho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `luot_gui`
--
ALTER TABLE `luot_gui`
  MODIFY `ma_luot_gui` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `ma_tai_khoan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `ma_the` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `luot_gui`
--
ALTER TABLE `luot_gui`
  ADD CONSTRAINT `luot_gui_ibfk_1` FOREIGN KEY (`ma_the`) REFERENCES `ve` (`ma_the`);

--
-- Các ràng buộc cho bảng `thong_tin_the`
--
ALTER TABLE `thong_tin_the`
  ADD CONSTRAINT `thong_tin_the_ibfk_1` FOREIGN KEY (`ma_the`) REFERENCES `ve` (`ma_the`),
  ADD CONSTRAINT `thong_tin_the_ibfk_2` FOREIGN KEY (`ma_can_ho`) REFERENCES `chu_ho` (`ma_can_ho`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

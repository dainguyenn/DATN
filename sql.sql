

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




--
-- Cơ sở dữ liệu: `guixe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bang_gia`
--

CREATE TABLE `bang_gia` (
  `ma_gia` int(11) NOT NULL,
  `loai_xe` varchar(7) DEFAULT NULL,
  `loai_ve` varchar(6) DEFAULT NULL,
  `khung_gio` varchar(4) DEFAULT NULL,
  `gia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Cấu trúc bảng cho bảng `chu_ho`
--

CREATE TABLE `chu_ho` (
  `ma_can_ho` varchar(5) NOT NULL,
  `ten_chu_ho` varchar(40) DEFAULT NULL,
  `cmnd` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Cấu trúc bảng cho bảng `luot_gui`
--

CREATE TABLE `luot_gui` (
  `ma_luot_gui` int(11) NOT NULL,
  `ma_ve` int(11) DEFAULT NULL,
  `bien_so_xe` varchar(10) DEFAULT NULL,
  `hinh_anh_vao` varchar(255) DEFAULT NULL,
  `hinh_anh_ra` varchar(255) DEFAULT NULL,
  `gio_vao` datetime DEFAULT NULL,
  `gio_ra` datetime DEFAULT NULL,
  `thanh_toan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `ten_tai_khoan` varchar(35) NOT NULL,
  `mat_khau` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Cấu trúc bảng cho bảng `thong_tin_ve`
--

CREATE TABLE `thong_tin_ve` (
  `ma_ve` int(11) NOT NULL,
  `ma_can_ho` varchar(5) DEFAULT NULL,
  `bien_so_xe` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `ma_ve` int(11) NOT NULL,
  `loai_ve` varchar(5) DEFAULT NULL,
  `loai_xe` varchar(7) DEFAULT NULL,
  `trang_thai` bit(1) DEFAULT b'1',
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bang_gia`
--
ALTER TABLE `bang_gia`
  ADD PRIMARY KEY (`ma_gia`);

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
  ADD KEY `ma_ve` (`ma_ve`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`ten_tai_khoan`);

--
-- Chỉ mục cho bảng `thong_tin_ve`
--
ALTER TABLE `thong_tin_ve`
  ADD PRIMARY KEY (`ma_ve`),
  ADD KEY `ma_can_ho` (`ma_can_ho`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`ma_ve`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bang_gia`
--
ALTER TABLE `bang_gia`
  MODIFY `ma_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `luot_gui`
--
ALTER TABLE `luot_gui`
  MODIFY `ma_luot_gui` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `ma_ve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `luot_gui`
--
ALTER TABLE `luot_gui`
  ADD CONSTRAINT `luot_gui_ibfk_1` FOREIGN KEY (`ma_ve`) REFERENCES `ve` (`ma_ve`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thong_tin_ve`
--
ALTER TABLE `thong_tin_ve`
  ADD CONSTRAINT `thong_tin_ve_ibfk_1` FOREIGN KEY (`ma_ve`) REFERENCES `ve` (`ma_ve`) ON DELETE CASCADE,
  ADD CONSTRAINT `thong_tin_ve_ibfk_2` FOREIGN KEY (`ma_can_ho`) REFERENCES `chu_ho` (`ma_can_ho`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

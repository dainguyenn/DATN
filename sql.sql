use
guixe;

CREATE TABLE chu_ho
(
    ma_can_ho  INT PRIMARY KEY,
    ten_chu_ho VARCHAR(255),
    cmnd       VARCHAR(12)
);

CREATE TABLE ve
(
    ma_ve      INT PRIMARY KEY AUTO_INCREMENT,
    loai_ve    VARCHAR(50),
    loai_xe    VARCHAR(255),
    trang_thai BIT DEFAULT true,
    deleted_at DATE
);

CREATE TABLE thong_tin_ve
(
    ma_ve      INT PRIMARY KEY,
    ma_can_ho  INT,
    bien_so_xe VARCHAR(10) UNIQUE,
    mo_ta TEXT,
    FOREIGN KEY (ma_ve) REFERENCES ve (ma_ve) ON DELETE CASCADE  ,
    FOREIGN KEY (ma_can_ho) REFERENCES chu_ho (ma_can_ho) ON DELETE CASCADE
);

CREATE TABLE luot_gui
(
    ma_luot_gui  INT PRIMARY KEY AUTO_INCREMENT,
    ma_ve        INT,
    bien_so_xe   VARCHAR(10),
    hinh_anh_vao VARCHAR(255),
    hinh_anh_ra  VARCHAR(255),
    gio_vao      DATETIME,
    gio_ra       DATETIME,
    thanh_toan   DATETIME,
    FOREIGN KEY (ma_ve) REFERENCES ve (ma_ve)
);

CREATE TABLE tai_khoan
(
    ma_tai_khoan  INT PRIMARY KEY,
    ten_tai_khoan VARCHAR(255),
    mat_khau      VARCHAR(255)
);

CREATE TABLE bang_gia
(
    ma_gia  INT PRIMARY KEY AUTO_INCREMENT,
    loai_xe VARCHAR(255),
    loai_ve VARCHAR(255),
    gia INT,
);

-- insert data into `chu_ho`
INSERT INTO `chu_ho` (`ma_can_ho`, `ten_chu_ho`, `cmnd`)
VALUES (1, 'Trần Tiến Tùng', '658975666632'),
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

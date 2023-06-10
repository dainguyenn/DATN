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
    loai_the   VARCHAR(50),
    loai_xe    VARCHAR(255),
    trang_thai BIT DEFAULT true
);

CREATE TABLE thong_tin_ve
(
    ma_ve      INT PRIMARY KEY,
    ma_can_ho  INT,
    bien_so_xe VARCHAR(10),
    FOREIGN KEY (ma_ve) REFERENCES ve (ma_ve),
    FOREIGN KEY (ma_can_ho) REFERENCES chu_ho (ma_can_ho)
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
    FOREIGN KEY (ma_ve) REFERENCES ve (ma_ve)
);

CREATE TABLE tai_khoan
(
    ma_tai_khoan  INT PRIMARY KEY,
    ten_tai_khoan VARCHAR(255),
    mat_khau      VARCHAR(255)
);
 
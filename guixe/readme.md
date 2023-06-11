# ENV#
Coppy file EnvConstExample thành EnvConst -> sửa các cấu hình cần thết <br>
# Lưu ý #: 
Nếu không dùng SQL log thì đặt thành false nếu dùng cấu hình lại path cho đúng


# Nếu dùng theo base #
- Từ view khi muốn gọi model phải required_one file autoload trước

- Chú ý file sql 

**Model**

***Insert***: attributes = [
    'a' => 1,
    'b' => 2
]

Insert bản ghi xong -> trả về bản ghi vừa tạo;
Update -> tườn tự trả về bản ghi vừa update

-Câu query tương ứng: INSERT INTO table(a,b) VALUES(1,2) 

Model ->
pdo->query($sql) -> thực hiện câu query và trả về mảng 
pdo->queryAndReturnId -> trả về id của bản ghi vừa được thêm - thường dùng cho insert để lấy id tạo quan hệ 1-1

Khai báo 1 model -> truyền tên table của bảng muốn model tham chiếu đến

Mỗi query get dữ liệu trả về mảng nếu có 1 bản ghi thì là phần tử 0 của mảng
EG:
```PHP
$VE = 
[
    0 -> [ma_the,ma_can_ho,loai_xe,bien_so],
    1 -> [ma_the,ma_can_ho,loai_xe,bien_so]
]
```



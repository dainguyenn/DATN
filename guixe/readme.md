**ENV**
Coppy file EnvConstExample thành EnvConst -> sửa các cấu hình cần thết <br>
***Lưu ý***: Nếu không dùng SQL log thì đặt thành false nếu dùng cấu hình lại path cho đúng
<br>

**Nếu dùng theo base**
<br>
**-** Từ view khi muốn gọi model phải required_one file autoload trước

- Chú ý file sql 

**Model**

***Insert***: attributes = [
    'a' => 1,
    'b' => 2
]

-Câu query tương ứng: INSERT INTO table(a,b) VALUES(1,2) 
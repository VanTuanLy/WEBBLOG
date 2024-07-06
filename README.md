# WEBBLOG
A. Tải và cài đặt xampp version 8.2.12 / PHP 8.2.12 để chạy được các file php

B. Nếu chưa có SQL Server Management Studio thì cần phải tải về vì em sử dụng công cụ đó để lưu database của web  

C. Sau khi tải xampp về thì để cài đặt và sử dụng thư viện sqlsrv (Microsoft Drivers for PHP for SQL Server) với XAMPP, cần thực hiện các bước sau:
1. Tải về và cài đặt driver SQLSRV:
- Truy cập trang Microsoft Drivers for PHP for SQL Server.
- Tải về phiên bản tương thích với PHP và hệ điều hành của bạn.
- Đảm bảo tải về cả sqlsrv và pdo_sqlsrv.
- Giải nén file tải về, bạn sẽ thấy các file .dll tương ứng với các phiên bản PHP khác nhau.
2. Copy các file .dll vào thư mục XAMPP:
- Mở thư mục cài đặt XAMPP của bạn (thường là C:\xampp).
- Tìm thư mục php\ext (ví dụ: C:\xampp\php\ext).
- Copy các file .dll (em copy 2 file này: php_pdo_sqlsrv_82_ts_x64.dll và php_sqlsrv_82_ts_x64.dll, tùy vào cấu hình của máy để chọn) vào thư mục ext này.
3. Cấu hình PHP để sử dụng driver SQLSRV:
- Mở file php.ini (thường nằm ở C:\xampp\php\php.ini) bằng một trình soạn thảo văn bản.
- Thêm các dòng sau vào phần Dynamic Extensions (cụ thể hơn thì em thêm ở phía trên của dòng chữ'[CLI Server]'):
```
extension=php_pdo_sqlsrv_82_ts_x64.dll
extension=php_sqlsrv_82_ts_x64.dll
```
(Tùy theo 2 file nào mà bạn copy ở phần 2 thì đổi cú pháp theo tên 2 file đó)
- Lưu file php.ini và đóng trình soạn thảo.
4. Khởi động lại Apache
- Mở XAMPP Control Panel.
- Bấm nút "Stop" cho Apache, sau đó bấm nút "Start" để khởi động lại Apache.
5. Kiểm tra cài đặt:
- Để chắc chắn rằng các extension đã được cài đặt thành công, bạn có thể tạo một file PHP để kiểm tra. Tạo một file mới tên là check_sqlsrv.php trong thư mục project của bạn (C:\xampp\htdocs\myproject\check_sqlsrv.php) và thêm nội dung sau:
```
<?php
if (extension_loaded('sqlsrv')) {
    echo 'SQLSRV extension is loaded!';
} else {
    echo 'SQLSRV extension is not loaded.';
}

if (extension_loaded('pdo_sqlsrv')) {
    echo 'PDO_SQLSRV extension is loaded!';
} else {
    echo 'PDO_SQLSRV extension is not loaded.';
}
?>
```
- Truy cập vào file này qua trình duyệt: http://localhost/myproject/check_sqlsrv.php. Nếu các extension được cài đặt đúng, bạn sẽ thấy thông báo SQLSRV extension is loaded! và PDO_SQLSRV extension is loaded!.

D. Sau khi cài đặt thành công thì đưa folder chứa project của em (trừ file webblog_database.sql) vào trong thư mục htdocs của XAMPP (thường nằm ở C:\xampp\htdocs trên Windows).

E. Sau đó cần phải tạo database trên sql server:

1. Mở SQL Server Management Studio (SSMS).
2. Kết Nối Tới SQL Server:
- Trong cửa sổ Connect to Server, điền các thông tin cần thiết:
+ Server type: Database Engine
+ Server name: Tên server của bạn (có thể là localhost hoặc tên máy chủ từ xa).
+ Authentication: Windows Authentication hoặc SQL Server Authentication (nếu sử dụng SQL Server Authentication, hãy nhập username và password của bạn).
- Nhấn Connect.
3. Nhấn vào nút New Query để tạo ra chỗ để viết code, sau đó copy code từ file webblog_database.sql vào chỗ đó.
4. Nhấn execute để chạy code

F. Lưu ý: Trong các file php có biến $serverName = "LAPTOP-MUS82LPQ" hãy đổi hết giá trị của biến đó thành tên server của bạn và nếu bạn sử dụng SQL Server Authentication ở bước 2 của phần E thì cần thêm các dòng code ở tất cả các biến $connectionOptions của các file php như sau:
```
$connectionOptions = array(
"Database" => "QLLOGIN",
"Uid" => "your_username", // Tên đăng nhập SQL Server
"PWD" => "your_password" // Mật khẩu SQL Server*/
);
```

G. Khởi Động XAMPP Control Panel: Mở XAMPP Control Panel và khởi động Apache

H. Truy Cập Dự Án từ Trình Duyệt: Truy cập vào dự án từ trình duyệt bằng cách nhập http://localhost/your_project_name. (http://localhost/WEBBLOG/html/index.html)

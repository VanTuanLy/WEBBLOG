<?php
session_start();
$serverName = "LAPTOP-MUS82LPQ"; // Tên server của bạn
$connectionOptions = array(
    "Database" => "QLLOGIN", // Tên cơ sở dữ liệu của bạn
    /*"Uid" => "your_username", // Tên đăng nhập SQL Server
    "PWD" => "your_password" // Mật khẩu SQL Server*/
);

// Kết nối đến SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Nhận dữ liệu từ biểu mẫu
$username = $_POST['username'];
$password = $_POST['passwords'];

// Truy vấn kiểm tra thông tin đăng nhập
$sql = "SELECT * FROM Users WHERE username = ? AND passwords = ?";
$params = array($username, $password);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Kiểm tra kết quả truy vấn
if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $row['email'];
    $_SESSION['yourname'] = $row['yourname'];
    header("Location: ../html/index.html");
}
else {
    header("Location: ../html/login.html");
}

// Đóng kết nối
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

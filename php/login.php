<?php
session_start();
require './connect.php';

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

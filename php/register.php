<?php
$serverName = "LAPTOP-MUS82LPQ"; // Tên server của bạn
$connectionOptions = array(
    "Database" => "QLLOGIN"
);

// Kết nối đến SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Nhận dữ liệu từ biểu mẫu
$yourname = $_POST['yourname'];
$username = $_POST['username'];
$password = $_POST['passwords'];
$email = $_POST['email'];

// Truy vấn kiểm tra xem tên người dùng đã tồn tại hay chưa
$sql_check = "SELECT * FROM Users WHERE username = ?";
$params_check = array($username);
$stmt_check = sqlsrv_query($conn, $sql_check, $params_check);

if ($stmt_check === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Nếu tên người dùng đã tồn tại
if (sqlsrv_fetch_array($stmt_check, SQLSRV_FETCH_ASSOC)) {
    echo "Username already exists.";
} else {
    // Chèn người dùng mới vào cơ sở dữ liệu
    $sql_insert = "INSERT INTO Users (yourname, username, passwords, email) VALUES (?, ?, ?, ?)";
    $params_insert = array($yourname, $username, $password, $email);
    $stmt_insert = sqlsrv_query($conn, $sql_insert, $params_insert);

    if ($stmt_insert === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo '
        <link rel="stylesheet" href="../assets/css/base.css">
        <link rel="stylesheet" href="../assets/css/main.css">
        <style>
            .auth-form__header {
                margin-top: 50px;
                display: block;
            }
            .notification {
                color: rgba(137,196,244);
                font-size: 2.5rem;
                margin-bottom: 30px;
                text-align: center;
            }

            .linktoLogin {
                text-decoration: none;
                font-size: 2.0rem;
                color: rgb(78, 164, 235);
            }
            .linklogin {
                text-align: center;
            }
        </style>
        <div class="modal">
            <div class="modal__overlay"></div>
                <div class="modal__body">
                    <div class="auth-form">
                        <div class="auth-form__container">
                            <div class="auth-form__logo">
                                <a href="../html/index.html" class="auth-form__logo">Logo</a>
                            </div>
                            <div class="auth-form__header">
                                <div class="notification">Registration successful!</div>
                                <div class="linklogin"><a href="../html/login.html" class="linktoLogin">RETURN TO LOGIN</a></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>    
        ';
    }
}

/*// Đóng kết nối
sqlsrv_free_stmt($stmt_check);
sqlsrv_free_stmt($stmt_insert);
sqlsrv_close($conn);*/
?>

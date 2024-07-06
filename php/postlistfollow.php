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

$sql = "SELECT WRITERS, TITLES, HASHTAGS, LIKES FROM WRITE_CONTENT, FOLLOW, Users WHERE FOLLOWER = username AND BE_FOLLOWED = WRITERS AND FOLLOWER = ? ORDER BY LIKES DESC";
$params = array($_SESSION['username']);
$stmt = sqlsrv_query($conn, $sql, $params);

/*if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .post__list {
            list-style: none;
            margin-left: 120px;
            margin-top: 50px;
            border-bottom: 1px solid #9b9b9b;
            width: 800px;
        }
        .post__list-author {
            font-size: 1.2rem;
            color: #6587c2;
            margin-bottom: 10px;
        }
        .post__list-title{
            font-size: 1.6rem;
            display: inline-block;
            text-align: left;
            margin-right: 50px;
        }
        .post__list-hashtag {
            border: 1px solid #6087c2;
            background-color: #6087c2;
            color: #fff;
            display: inline-block;
            padding-top: 3px;
            padding-right: 3px;
            padding-left: 3px;
            border-radius: 3px;
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .post__list-title--link {
            text-decoration: none;
            color: black;
            display: inline-block;
        }
        .post__list-title--link:hover {
            color: #6587c2;
        }

        .post__list-likes {
            margin-bottom: 12px;
            margin-top: 12px;
        }
    </style>
</head>
<body>
    <?php
        if ($stmt === false) {
            echo '';
        }
        else {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo    '
                        <ul class="post__list">
                            <li class="post__list-author">Author:  '. $row["WRITERS"] .'
                            <li class="post__list-title"> <a class="post__list-title--link" href="./content.php?writer='.$row["WRITERS"].'&title='.$row["TITLES"].'"> Title:  '. $row["TITLES"] .' </a> 
                            <li class="post__list-hashtag">'. $row["HASHTAGS"] .'</li>
                            <li class="post__list-likes"> <i class="fa-regular fa-heart"></i> '. $row["LIKES"] .' </li>
                        </ul>
                        ';
            }
        }
        // Đóng kết nối và giải phóng tài nguyên
        /*sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);*/
    ?>
    <script src="./main.js"></script>
</body>
</html>
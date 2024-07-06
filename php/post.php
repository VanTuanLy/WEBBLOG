<?php
session_start();
require './connect.php';

// Nhận dữ liệu từ biểu mẫu
$writers = $_SESSION['username'];
$titles = $_POST['TITLES'];
$hashtags = $_POST['HASHTAGS'];
$contents = $_POST['CONTENTS'];

// Chèn contents mới vào cơ sở dữ liệu
$sql_insert = "INSERT INTO WRITE_CONTENT ( WRITERS ,TITLES, HASHTAGS, CONTENTS) VALUES (?, ?, ?, ?)";
$params_insert = array($writers ,$titles, $hashtags, $contents);
$stmt_insert = sqlsrv_query($conn, $sql_insert, $params_insert);

if ($stmt_insert === false) {
    die(print_r(sqlsrv_errors(), true));
} 
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
        #content {

        }
        .content__body {
            list-style: none;
            margin-left: 100px;
            margin-top: 50px;
            margin-right: 100px;
        }

        .content__writer {
            font-size: 1.4rem;
            color: #6587c2;
            margin-bottom: 12px;
            display: inline-block;
            margin-right: 30px;
        }

        .content__follow {
            display: inline-block;
        }

        .content__follow-btn {
            background-color: #fff;
            border: 1px solid black;
            margin-right: 12px;
            cursor: pointer;
        }

        .content__follow-btn:hover {
            border-color: #6587c2;
            color: #6587c2;
        }

        .content__like {
            display: inline-block;
        }

        .content__like-btn {
            background-color: #fff;
            border: none;
        }

        .fa-heart {
            font-size: 1.4rem;
            cursor: pointer;
            color: #9b9b9b;
        }

        .content__hashtag {
            border: 1px solid #6087c2;
            background-color: #6087c2;
            color: #fff;
            display: inline-block;
            padding: 5px;
            border-radius: 3px;
            font-size: 1.3rem;
            margin-bottom: 30px;
            margin-right: 6px;
        }
        
        .content__title {
            font-size: 1.8rem;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .content__contents {
           word-wrap: break-word;
        }

        .content__link {
            margin-top: 50px;
        }

        .content__link-home {
            text-decoration: none;
            color: #6087c2;
            font-size: 1.4rem;
        }
        
    </style>
</head>
<body>
    <div id="content">
        <ul class="content__body">
            <?php
                echo '
                <li class="content__writer">
                    Tác giả: '. $writers .'
                </li>
                <li class="content__follow">
                    <button onclick="follow()" id="follow-btn" class="content__follow-btn">
                        Theo dõi
                    </button> 
                </li>
                <li class="content__hashtag">
                    Tag: '. $hashtags .'
                </li>
                <li class="content__like">
                    <button onclick="like()" id="like-btn" class="content__like-btn">
                        <i class="fa-solid fa-heart"></i>
                    </button> 
                </li>
                <li class="content__title">
                    Tiêu đề: '.$titles .'
                </li>
                <li class="content__contents">
                    '. $contents .'
                </li>
                <li class="content__link">
                    <a href="../html/index.html" class="content__link-home"> RETURN </a>
                </li>
                '
            ?>
        </ul>
    </div>
</body>
</html>
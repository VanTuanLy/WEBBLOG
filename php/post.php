<?php
session_start();
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
} /*else {
    echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="./assets/css/base.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .content__body {
                list-style: none;
                margin-top: 90px;
                margin-left: 154px;
            }
            .content__writer {
                font-size: 2rem;
                color: #6087c2;
                margin-bottom: 37px;
            }
            .content__title {
                font-size: 3.5rem;
                margin-bottom: 30px;
                font-weight: bold;

            }
            .content__hashtag {
                font-size: 1.6rem;
                margin-bottom: 60px;
            }
            .content__contents {
                font-size: 2rem;
                line-height: 0.3rem;
            }
        </style>
        <div class="app">
        <header class="header">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item">
                            <a href="./index.html" class="header__navbar-item-link">Logo</a>
                        </li>
                        <li class="header__navbar-item">
                            <a href="./index.html" class="header__navbar-item-link">Bài Viết</a>
                        </li>
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">Hỏi Đáp</a>
                        </li>
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">Thảo Luận</a>
                        </li>
                    
                        <li class="header__navbar-item header__navbar-search">
                            <input type="text" class="header__navbar-item--search" placeholder="Tìm kiếm">
                            <button class="header__navbar-item--btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </li>
                        <li class="header__navbar-item header__navbar-item--click">
                            Thông tin
                            <div class="header__notify">
                                <header class="header__notify-header">
                                    <h3>Thông tin</h3>
                                </header>
                                <ul class="header__notify-list">
                                    <li class="header__notify-item">
                                        <a href="" class="header__notify-link">
                                            <div class="header__notify-info">
                                                <span class="header__notify-name">Tổng Kết và Công Bố Kết quả Chính Thức May Fest 2024</span>
                                                <span class="header__notify-description">Thứ 6, 8:00 CH</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="header__notify-item">
                                        <a href="" class="header__notify-link">
                                            <div class="header__notify-info">
                                                <span class="header__notify-name">Tổng Kết và Công Bố Kết quả Chính Thức May Fest 2024</span>
                                                <span class="header__notify-description">Thứ 6, 8:00 CH</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <footer class="header__notify-footer">
                                    <a href="" class="header__notify-footer--link">Tất cả thông tin</a>
                                </footer>
                            </div>
                        </li>
                        <li class="header__navbar-item">VI</li>
                        <li class="header__navbar-item" id="login-register">
                            <a href="./profile.html" class="header__navbar-item-link header__navbar-item-link--strong">'.$writers.'</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </header>
        </div>
        <div class="container">
            <div class="container__image">
                <img class="image" src="https://images.viblo.asia/full/2ea73483-c88e-4a1e-bcf5-d889a15998a8.png" alt="">
            </div>
            <ul class="content__body">
                <li class="content__writer">
                    Tác giả: ' .$writers.'
                </li>
                <li class="content__title">
                    ' .$titles.'
                </li>
                <li class="content__hashtag">
                    Tag: ' .$hashtags.'
                </li>
                <li class="content__contents">
                    ' .$contents. '
                </li>
            </ul>
        </div>';
}*/

/*// Đóng kết nối
sqlsrv_free_stmt($stmt_check);
sqlsrv_free_stmt($stmt_insert);
sqlsrv_close($conn);*/
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
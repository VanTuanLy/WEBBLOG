<?php
session_start();
if(isset($_GET['writer']) && isset($_GET['title'])) {
    $writer = $_GET['writer'];
    $title = $_GET['title'];
    $_SESSION['writer'] = $_GET['writer'];
    $_SESSION['title'] = $_GET['title'];
}
$serverName = "LAPTOP-MUS82LPQ"; // Tên server của bạn
$connectionOptions = array(
    "Database" => "QLLOGIN"
);

// Kết nối đến SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT * FROM WRITE_CONTENT WHERE WRITERS = ? AND TITLES = ? ";
$params = array($writer, $title);
$stmt = sqlsrv_query($conn, $sql, $params);

$sqls = "SELECT * FROM COMMENT WHERE WRITERS = ? AND TITLES = ? ";
$paramss = array($writer, $title);
$stmts = sqlsrv_query($conn, $sqls, $paramss);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$post = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
/*$_SESSION['WRITERS'] = $post['WRITERS']
$_SESSION['TITLES'] = $post['WRITERS']*/
$USERNAMES = $_SESSION['username'];
$_SESSION['content'] = $post["CONTENTS"];
$_SESSION['hashtag'] = $post["HASHTAGS"];
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
            margin-left: 140px;
            margin-top: 50px;
            margin-right: 100px;
        }
        .content__body {
            list-style: none;
            padding: 0;
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

        .content__unfollow {
            display: inline-block;
        }

        .content__unfollow-btn {
            background-color: #fff;
            border: 1px solid black;
            margin-right: 12px;
            cursor: pointer;
        }

        .content__unfollow-btn:hover {
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

        .content__comment {
            text-align:;
        }

        .content__comment-form {
            text-align: center;
        }

        textarea {
            resize: both;
            width: 840px;
            height: 100px;
            padding: 10px;
            border: 1px solid #c1c4cb;
            font-size: 1rem;
            border-radius: 3px;
            line-height: 1.5;
        }

        textarea:focus {
            border-color: #c1c4cb;
            outline: none;
        }

        .content__comment-btn {
            border: none;
            background-color: #6087c2;
            color: #fff;
            border-radius: 3px;
            padding: 10px;
            cursor: pointer;
            font-size: 1rem;
        }

        .content__comment-btn:hover {
            background-color: #3a6ebc;
        }

        .content__comment-list {
            list-style: none;
            text-align: left;
            margin-bottom: 30px;
            padding: 0;
        }

        .content__comment-item {
            font-size: 1.2rem;
            display: inline;
        }

        .comment-user {
            color: #6087c2;
        }

        
    </style>
</head>
<body>
    <div id="content">
        <ul class="content__body">
            <?php
                echo '
                <li class="content__writer">
                    Author: '. $post["WRITERS"] .'
                </li>
                <li id="follow" class="content__follow">
                    <button onclick="follow()" id="follow-btn" class="content__follow-btn">
                        Follow
                    </button> 
                </li>
                <li class="content__hashtag">
                    Tag: '. $post["HASHTAGS"] .'
                </li>
                <li class="content__like">
                    <button onclick="like()" id="like-btn" class="content__like-btn">
                        <i class="fa-solid fa-heart"></i>
                    </button> 
                </li>
                <li class="content__title">
                    Title: '. $post["TITLES"] .'
                </li>
                <li class="content__contents">
                    '. $post["CONTENTS"] .'
                </li>
                '
            ?>
        </ul>
        <div class="content__comment">
            <p class="content__writer">Comment</p>
            <form action="./comment.php" method="post"class="content__comment-form">
                <label for="comment"></label>
                <textarea name="comment" id="comment"></textarea>
                <button type="submit" class="content__comment-btn">Comment</button>
                <?php
                    while ($row = sqlsrv_fetch_array($stmts, SQLSRV_FETCH_ASSOC)) {
                        echo '
                            <ul class="content__comment-list">
                                <li class="content__comment-item comment-user">'.$row["USERS"].': </li>
                                <li class="content__comment-item">'.$row["COMMENTS"].'</li>
                            </ul>
                            ';
                    };
                ?>
            </form>
        </div>
    </div>
    <script>
        function like() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./like.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            document.getElementById("like-btn").innerHTML = `<i style="color: red;" class="fa-solid fa-heart"></i>`;
            xhr.send("writer=<?php echo urlencode($writer); ?>&title=<?php echo urlencode($title); ?>");
        }

        function follow() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./follow.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            document.getElementById("follow").innerHTML = `<button onclick="unfollow()" id="follow-btn" class="content__follow-btn">Unfollow</button>`;
            xhr.send("writer=<?php echo urlencode($writer); ?>&title=<?php echo urlencode($title); ?>");
        }

        function unfollow() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./unfollow.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            document.getElementById("follow").innerHTML = `<button onclick="follow()" id="follow-btn" class="content__follow-btn">Follow</button>`;
            xhr.send("writer=<?php echo urlencode($writer); ?>&title=<?php echo urlencode($title); ?>");
        }

        fetch('./checkfollow.php')
        .then(response => response.json())
        .then(data => {
                if (data.followed) {
                    document.getElementById("follow").innerHTML = `<button onclick="unfollow()" id="follow-btn" class="content__follow-btn">Unfollow</button>`;
                }
            }
        );
    </script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
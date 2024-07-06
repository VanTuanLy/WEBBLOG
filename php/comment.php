<?php
session_start();
$writer = $_SESSION['writer'];
$title = $_SESSION['title'];
$username = $_SESSION['username'];
$content = $_SESSION['content'];
$hashtag = $_SESSION['hashtag'];

require './connect.php';

// Nhận dữ liệu từ biểu mẫu
$comment = $_POST['comment'];
$_SESSION['comment'] = $comment;

$sql = "INSERT INTO COMMENT (WRITERS, TITLES, COMMENTS, USERS) VALUES (?, ?, ?, ?)";
$param = array($writer, $title, $comment, $username);
$stmt = sqlsrv_query($conn, $sql, $param);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

//header("Location: ./content.php?writer='.$writer.'&title='.$title.'");

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

        .content__comment {
            margin-left: 140px;
            margin-top: 50px;
            margin-right: 100px;
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

        .content__comment-return {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <div class="content__comment">
        <h3>Your comment</h3>
        <?php
            echo '
            <ul class="content__comment-list">
                <li class="content__comment-item comment-user">'.$username.'</li>
                <li class="content__comment-item">'.$comment.'</li>
            </ul>
            ';
            echo '<a href="./content.php?writer='.$writer.'&title='.$title.'" class="content__comment-return">RETURN</a>';
        ?>
    </div>
</body>
</html>
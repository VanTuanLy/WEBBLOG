<?php
session_start();
require './connect.php';

$writer = $_SESSION['writer'];
$title = $_SESSION['title'];
$username = $_SESSION['username'];

$sql = "DELETE FROM FOLLOW WHERE FOLLOWER = ? AND BE_FOLLOWED = ?";
$params= array($username, $writer);
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Success";

?>
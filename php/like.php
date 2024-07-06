<?php
session_start();

require './connect.php';

$writer = $_SESSION['writer'];
$title = $_SESSION['title'];

$sql = "UPDATE WRITE_CONTENT SET LIKES = LIKES + 1 WHERE WRITERS = ? AND TITLES = ? ";
$params= array($writer, $title);
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Success";

?>
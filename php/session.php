<?php
session_start();

$response = array(
    'loggedin' => false
);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $response['loggedin'] = true;
    $response['username'] = $_SESSION['username'];
    $response['email'] = $_SESSION['email'];
    $response['yourname'] = $_SESSION['yourname'];
}

echo json_encode($response);
?>

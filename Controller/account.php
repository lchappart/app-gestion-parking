<?php

require "Model/account.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if (!empty($_GET['action']) && $_GET['action'] == 'edit') {
        $username = $_POST['username'] ?? cleanString($_POST['username']);
        $email = $_POST['email'] ?? cleanString($_POST['email']);
        $password = $_POST['password'] ?? cleanString($_POST['password']);
        $confirm_password = $_POST['confirmPassword'] ?? cleanString($_POST['confirmPassword']);
        $phone = $_POST['phone'] ?? cleanString($_POST['phone']);
        $account = editAccount($pdo, $username, $email,  $phone);

        if ($password != null && $confirm_password != null && $password == $confirm_password) {
            $account = editPassword($pdo, $password);
        }
        echo json_encode($account);
        exit;
    }
}
$user = getUser($pdo, $_SESSION['user_id']);
require "View/account.php";

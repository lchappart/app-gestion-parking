<?php

require "Model/users.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if (!empty($_GET['action']) && $_GET['action'] == 'list') {
        $users = getUsers($pdo);
        echo json_encode($users);
    }
    if (isset($_GET['action']) && $_GET['action'] == 'toggle_enabled') {
        $res = toggleEnabledUser($pdo, $_GET['id']);
        echo json_encode($res);
        exit;
    }
    if (!empty($_GET['action']) && $_GET['action'] == 'delete') {
        $res = deleteUser($pdo, $_GET['id']);
        echo json_encode($res);
        exit;
    }
}

require "View/users.php";
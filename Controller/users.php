<?php

require "Model/users.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if (!empty($_GET['action']) && $_GET['action'] == 'list') {
        $users = getUsers($pdo);
        echo json_encode($users);
    }
}

require "View/users.php";
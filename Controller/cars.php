<?php

require "Model/cars.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if ($_GET['action'] == 'getCars') {
        $cars = getCars($pdo, $_SESSION['user_id']);
        echo json_encode($cars);
        exit();
    }
    if ($_GET['action'] == 'delete') {
        $id = cleanString($_GET['id']);
        deleteCar($pdo, $id);
        echo json_encode(['success' => true]);
        exit();
    }
    if ($_GET['action'] == 'list') {
        $cars = getAllCars($pdo, $_SESSION['user_id']);
        echo json_encode($cars);
        exit();
    }
}

require "View/cars.php";


<?php

require 'Model/place.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_POST['number']) && isset($_POST['type'])) {
        $id = cleanString($_GET['id']);
        $number = cleanString($_POST['number']);
        $type = cleanString($_POST['type']);
        $place = editPlace($pdo, $id, $number, $type);
        echo json_encode(['success' => $place > 0]);
        exit;
    }

    if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_POST['number']) && isset($_POST['type'])) {
        $number = cleanString($_POST['number']);
        $type = cleanString($_POST['type']);
        $place = addPlace($pdo, $number, $type);
        echo json_encode(['success' => $place->rowCount() > 0]);
        exit;
    }

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = cleanString($_GET['id']);
        $place = deletePlace($pdo, $id);
        echo json_encode(['success' => $place > 0]);
        exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = cleanString($_GET['id']);
    $place = getPlace($pdo, $id);
}

require 'View/place.php';

<?php
require "Model/places.php";

/**
 * @var PDO $pdo
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if (!empty($_GET['action']) && $_GET['action'] == 'list') {
        $places = getPlaces($pdo);
        echo json_encode($places);
        exit;
    }
    if (!empty($_GET['action']) && $_GET['action'] == 'edit') {
        $place = getPlace($pdo);
        echo json_encode($place);
        exit;
    }
}

    require "View/places.php";

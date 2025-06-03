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
    }
}

    require "View/places.php";

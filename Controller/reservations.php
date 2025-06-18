<?php
require 'Model/reservations.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if ($_GET['action'] === 'listByUser') {
        $reservations = getReservationsByUser($pdo, $_SESSION['user_id']);
        echo json_encode($reservations);
        exit();
    }
}
require 'View/reservations.php';
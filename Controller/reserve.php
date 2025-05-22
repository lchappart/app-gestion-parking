<?php
require "Model/reserve.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    
    if (!isset($_POST['reservationDate']) || !isset($_POST['reservationStartTime']) || 
        !isset($_POST['reservationEndTime']) || !isset($_POST['vehicleSelect'])) {
        echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs']);
        exit();
    }
    
    $reservations = getReservationsAtDate($pdo, $_POST['reservationDate']);
    if (count($reservations) >= 10) { // Pour 10 placces de parking
        echo json_encode(['success' => false, 'message' => 'Aucune place disponible à cette date']);
        exit();
    }

    $userId = $_SESSION['user_id'];
    $vehicleSelect = $_POST['vehicleSelect'];
    $reservationDate = $_POST['reservationDate'];
    $startTime = $_POST['reservationStartTime'];
    $endTime = $_POST['reservationEndTime'];
    
    try {
        $result = saveReservation($pdo, $userId, $vehicleSelect, $reservationDate, $startTime, $endTime);
        if ($result) {
            $placeNumber = getPlaceNumber($pdo, $_POST['reservationDate']) - 1;
            echo json_encode([
                'success' => true, 
                'message' => 'Réservation effectuée avec succès', 
                'placeNumber' => $placeNumber
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la réservation']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()]);
    }
    
    exit();
}

require "View/reserve.php";
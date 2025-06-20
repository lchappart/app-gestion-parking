<?php
require "Model/reserve.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');

    try {
        $availablePlaces = getPlacesNumber($pdo);

        if (isset($_GET['action']) && $_GET['action'] == 'getPrice') {
            $price = getPriceByHours($pdo);
            echo json_encode($price);
            exit();
        }

        if (isset($_GET['action']) && $_GET['action'] == 'list') {
            $reservations = getReservations($pdo);
            echo json_encode($reservations);
            exit();
        }

        if (!isset($_POST['reservationDate']) || !isset($_POST['reservationStartTime']) || 
            !isset($_POST['reservationEndTime']) || !isset($_POST['vehicleSelect']) || !isset($_POST['price'])) {
            throw new Exception('Veuillez remplir tous les champs');
        }

        $reservationDate = cleanString($_POST['reservationDate']);
        $startTime = cleanString($_POST['reservationStartTime']);
        $endTime = cleanString($_POST['reservationEndTime']);
        $vehicleSelect = cleanString($_POST['vehicleSelect']);
        $price = cleanString($_POST['price']);

        if (!$reservationDate || !$startTime || !$endTime || !$vehicleSelect || !$price) {
            throw new Exception('Données invalides');
        }

        $reservations = getReservationsAtDate($pdo, $reservationDate);
        if (count($reservations) >= $availablePlaces) {
            throw new Exception('Aucune place disponible à cette date');
        }

        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Vous devez être connecté pour effectuer une réservation');
        }

        $userId = $_SESSION['user_id'];
        
        $result = saveReservation($pdo, $userId, $vehicleSelect, $reservationDate, $startTime, $endTime, $price);
        
        if ($result) {
            $placeNumber = getPlaceNumber($pdo, $reservationDate) - 1;
            echo json_encode([
                'success' => true, 
                'message' => 'Réservation effectuée avec succès', 
                'placeNumber' => $placeNumber
            ]);
        } else {
            throw new Exception('Erreur lors de la réservation');
        }

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit();
}

require "View/reserve.php";
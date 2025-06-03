<?php

function getReservationsAtDate($pdo, $reservationDate) {
    $query = $pdo->prepare("SELECT * FROM reservations WHERE reservation_date = :reservation_date");
    $query->bindParam(":reservation_date", $reservationDate, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getPlaceNumber($pdo, $reservationDate) {
    $query = $pdo->prepare("SELECT COUNT(*) as count FROM reservations WHERE reservation_date = :reservation_date");
    $query->bindParam(":reservation_date", $reservationDate, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['count'] + 1; 
}

function getPlaceIdbyNumber($pdo, $placeNumber) {
    $query = $pdo->prepare("SELECT id FROM places WHERE number = :place_number");
    $query->bindParam(":place_number", $placeNumber, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC)['id'];
}

function saveReservation($pdo, $userId, $vehicleSelect, $reservationDate, $startTime, $endTime) {
    $placeNumber = getPlaceNumber($pdo, $reservationDate);
    $placeId = getPlaceIdbyNumber($pdo, $placeNumber);

    $start = strtotime($startTime);
    $end = strtotime($endTime);
    $durationHours = ($end - $start) / 3600; 
    
    $query = $pdo->prepare("INSERT INTO reservations 
                          (user_id, vehicle_name, reservation_date, start_time, end_time, place_id) 
                          VALUES (:user_id, :vehicle_name, :reservation_date, :start_time, :end_time, :place_id)");
    
    $query->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $query->bindParam(":vehicle_name", $vehicleSelect, PDO::PARAM_STR);
    $query->bindParam(":reservation_date", $reservationDate, PDO::PARAM_STR);
    $query->bindParam(":start_time", $start, PDO::PARAM_STR);
    $query->bindParam(":end_time", $end, PDO::PARAM_STR);
    $query->bindParam(":place_id", $placeId, PDO::PARAM_INT);
    
    return $query->execute();
}

function getReservations($pdo) {
    $query = $pdo->prepare("SELECT * FROM reservations");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


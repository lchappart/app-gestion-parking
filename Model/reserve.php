<?php

function getReservationsAtDate($pdo, $reservationDate) {
    $query = $pdo->prepare("SELECT * FROM reservations WHERE DATE(start_time) = :reservation_date AND status != 'cancelled'");
    $query->bindParam(":reservation_date", $reservationDate, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getPlaceNumber($pdo, $reservationDate) {
    $query = $pdo->prepare("SELECT COUNT(*) as count FROM reservations WHERE DATE(start_time) = :reservation_date AND status != 'cancelled'");
    $query->bindParam(":reservation_date", $reservationDate, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['count'] + 1; 
}

function getPlaceIdbyNumber($pdo, $placeNumber) {
    $query = $pdo->prepare("SELECT id FROM places WHERE number = :place_number");
    $query->bindParam(":place_number", $placeNumber, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['id'] : null;
}

function isPlaceAvailable($pdo, $placeId, $startDateTime, $endDateTime) {
    $query = $pdo->prepare("SELECT COUNT(*) as count FROM reservations 
                           WHERE place_id = :place_id 
                           AND status != 'cancelled'
                           AND (
                               (start_time BETWEEN :start_time AND :end_time)
                               OR (end_time BETWEEN :start_time AND :end_time)
                               OR (:start_time BETWEEN start_time AND end_time)
                           )");
    
    $query->bindParam(":place_id", $placeId, PDO::PARAM_INT);
    $query->bindParam(":start_time", $startDateTime, PDO::PARAM_STR);
    $query->bindParam(":end_time", $endDateTime, PDO::PARAM_STR);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['count'] === 0;
}

function saveReservation($pdo, $userId, $vehicleSelect, $reservationDate, $startTime, $endTime, $price) {
    try {
        $pdo->beginTransaction();

        // Vérifier si la date est dans le futur
        if (strtotime($reservationDate) < strtotime(date('Y-m-d'))) {
            throw new Exception("La date de réservation ne peut pas être dans le passé");
        }

        // Vérifier si l'heure de fin est après l'heure de début
        if (strtotime($startTime) >= strtotime($endTime)) {
            throw new Exception("L'heure de fin doit être après l'heure de début");
        }

        $placeNumber = getPlaceNumber($pdo, $reservationDate);
        $placeId = getPlaceIdbyNumber($pdo, $placeNumber);
        
        if (!$placeId) {
            throw new Exception("Place de parking non trouvée");
        }

        $startDateTime = date('Y-m-d H:i:s', strtotime($reservationDate . ' ' . $startTime));
        $endDateTime = date('Y-m-d H:i:s', strtotime($reservationDate . ' ' . $endTime));

        // Vérifier si la place est disponible
        if (!isPlaceAvailable($pdo, $placeId, $startDateTime, $endDateTime)) {
            throw new Exception("Cette place n'est pas disponible pour la période sélectionnée");
        }

        // Formater le prix correctement
        $formattedPrice = number_format((float)str_replace(',', '.', $price), 2, '.', '');
        
        $query = $pdo->prepare("INSERT INTO reservations 
                              (user_id, vehicle_name, place_id, start_time, end_time, status, place_number, date, price) 
                              VALUES (:user_id, :vehicle_name, :place_id, :start_time, :end_time, 'confirmed', :place_number, :date, :price)");
        
        $query->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $query->bindParam(":vehicle_name", $vehicleSelect, PDO::PARAM_STR);
        $query->bindParam(":place_id", $placeId, PDO::PARAM_INT);
        $query->bindParam(":start_time", $startDateTime, PDO::PARAM_STR);
        $query->bindParam(":end_time", $endDateTime, PDO::PARAM_STR);
        $query->bindParam(":place_number", $placeNumber, PDO::PARAM_INT);
        $query->bindParam(":date", $reservationDate, PDO::PARAM_STR);
        $query->bindParam(":price", $formattedPrice, PDO::PARAM_STR);

        $result = $query->execute();
        
        if (!$result) {
            throw new Exception("Erreur lors de l'enregistrement de la réservation");
        }

        $pdo->commit();
        return true;

    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function getReservations($pdo) {
    $query = $pdo->prepare("SELECT * FROM reservations ORDER BY date DESC, start_time ASC");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getPlacesNumber($pdo) {
    $query = $pdo->prepare("SELECT COUNT(*) as count FROM places");
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC)['count'];
}

function getPriceByHours($pdo) {
    $query = $pdo->prepare("SELECT * FROM tarifs");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
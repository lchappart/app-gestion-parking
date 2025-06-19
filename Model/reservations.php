<?php

function getReservationsByUser($pdo, $userId) {
    $query = $pdo->prepare("SELECT * FROM reservations WHERE user_id = :userId");
    $query->bindParam(':userId', $userId);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function cancelReservation($pdo, $id) {
    $query = $pdo->prepare("UPDATE reservations SET status = 'canceled' WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->rowCount();
}
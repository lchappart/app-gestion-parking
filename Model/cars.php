<?php

function getCars(PDO $pdo, int $userId) {
    $query = $pdo->prepare('SELECT * FROM `vehicles` WHERE user_id = :userId');
    $query->bindParam(':userId', $userId);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function deleteCar(PDO $pdo, int $id) {
    $query = $pdo->prepare('DELETE FROM `vehicles` WHERE id = :id');
    $query->bindParam(':id', $id);
    $query->execute();
}

function getAllCars(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM `vehicles`');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


<?php

function getPlace($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM places WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editPlace($pdo, $id, $number, $type) {
    $stmt = $pdo->prepare("UPDATE places SET number = :number, type = :type WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':number', $number, PDO::PARAM_STR);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount();
}

function addPlace($pdo, $number, $type) {
    $stmt = $pdo->prepare("INSERT INTO places (number, type) VALUES (:number, :type)");
    $stmt->bindValue(':number', $number, PDO::PARAM_STR);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}

function deletePlace($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM places WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}
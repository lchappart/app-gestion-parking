<?php

function getPlaces(PDO $pdo): array {
    $query = "SELECT * FROM places";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



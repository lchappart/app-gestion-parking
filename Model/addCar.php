<?php
function addCar(PDO $pdo, string $vehicleType, string $vehicleImmatriculation, string $carModel)     {
    $res = $pdo->prepare("INSERT INTO vehicles (user_id, type, immatriculation, model) VALUES (:userId, :vehicleType, :vehicleImmatriculation, :carModel)");
    $res->bindParam(":userId", $_SESSION['user_id'], PDO::PARAM_INT);
    $res->bindParam(":vehicleType", $vehicleType, PDO::PARAM_STR);
    $res->bindParam(":vehicleImmatriculation", $vehicleImmatriculation, PDO::PARAM_STR);
    $res->bindParam(":carModel", $carModel, PDO::PARAM_STR);
    $res->execute();
}

function getCar(PDO $pdo, string $id) {
    $res = $pdo->prepare("SELECT * FROM vehicles WHERE id = :id");
    $res->bindParam(":id", $id, PDO::PARAM_INT);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
}

function editCar(PDO $pdo, string $vehicleType, string $vehicleImmatriculation, string $carModel, string $id) {
    $res = $pdo->prepare("UPDATE vehicles SET type = :vehicleType, immatriculation = :vehicleImmatriculation, model = :carModel WHERE id = :id");
    $res->bindParam(":vehicleType", $vehicleType, PDO::PARAM_STR);
    $res->bindParam(":vehicleImmatriculation", $vehicleImmatriculation, PDO::PARAM_STR);
    $res->bindParam(":carModel", $carModel, PDO::PARAM_STR);
    $res->bindParam(":id", $id, PDO::PARAM_INT);
    $res->execute();
}

function deleteCar(PDO $pdo, string $id) {
    $res = $pdo->prepare("DELETE FROM vehicles WHERE id = :id");
    $res->bindParam(":id", $id, PDO::PARAM_INT);
    $res->execute();
}
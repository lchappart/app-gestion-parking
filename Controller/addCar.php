<?php

require 'Model/addCar.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        if (!empty($_POST['vehicleType']) && !empty($_POST['vehicleImmatriculation']) && !empty($_POST['carModel'])) {
            $vehicleType = cleanString($_POST['vehicleType']);
            $vehicleImmatriculation = cleanString($_POST['vehicleImmatriculation']);
            $carModel = cleanString($_POST['carModel']);
            addCar($pdo, $vehicleType, $vehicleImmatriculation, $carModel);
            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['errors' => ['Veuillez remplir tous les champs']]);
            exit();
        }
    }

    if (!empty($_GET['action']) && $_GET['action'] == 'edit') {
        $id = cleanString($_GET['id']);
        $car = getCar($pdo, $id);
    }

    if (!empty($_POST['vehicleType']) && !empty($_POST['vehicleImmatriculation']) && !empty($_POST['carModel']) && !empty($_POST['id'])) {
        $vehicleType = cleanString($_POST['vehicleType']);
        $vehicleImmatriculation = cleanString($_POST['vehicleImmatriculation']);
        $carModel = cleanString($_POST['carModel']);
        $id = cleanString($_POST['id']);
        editCar($pdo, $vehicleType, $vehicleImmatriculation, $carModel, $id);
        echo json_encode(['success' => true]);
        exit();
    }

require 'View/addCar.php';

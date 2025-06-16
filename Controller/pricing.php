<?php

require "Model/pricing.php";

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if (!empty($_GET['action']) && $_GET['action'] == 'list') {
        $pricing = getPricing($pdo);
        echo json_encode($pricing);
        exit;
    }
    if (!empty($_GET['action']) && $_GET['action'] == 'edit') {
        $pricing = editPricing($pdo, $_POST['vehicleType'], $_POST['pricing']);
        echo json_encode($pricing);
        exit;
    }
}

require "View/pricing.php";
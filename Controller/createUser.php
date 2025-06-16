<?php
require "Model/createUser.php";

/**
 * @var PDO $pdo
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_POST['email']) && !empty($_POST['phoneNumber'])) {
        $username = cleanString($_POST['username']);
        $pass = cleanString($_POST['password']);
        $passConfirm = cleanString($_POST['confirmPassword']);
        $email = cleanString($_POST['email']);
        $phoneNumber = cleanString($_POST['phoneNumber']);
        date_default_timezone_set('Europe/Paris');
        $date = date('d/m/Y', time());
        $user = getUser($pdo, $username, $email, $phoneNumber);
        if (!empty($user)) {
            echo json_encode(['errors' => ["L'utilisateur existe déjà"]]);
            exit();
        }
        if ($pass !== $passConfirm) {
            echo json_encode(['errors' => ["Les mots de passe ne correspondent pas"]]);
            exit();
        }
        createUser($pdo, $username, $pass, $email, $phoneNumber, $date);
        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['errors' => ['Veuillez remplir tous les champs']]);
        exit();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        $id = cleanString($_GET['id']);
        $user = getUserById($pdo, $id);
        if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phoneNumber'])) {
            $username = cleanString($_POST['username']);
            $email = cleanString($_POST['email']);
            $phoneNumber = cleanString($_POST['phoneNumber']);
            updateUser($pdo, $id, $username, $email, $phoneNumber);
            echo json_encode(['success' => true]);
        }
    }
} else {
    require 'View/createUser.php';
}


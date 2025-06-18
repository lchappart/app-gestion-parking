<?php
require "Model/createUser.php";

/**
 * @var PDO $pdo
 */

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    
    try {
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            // Gestion de la modification d'utilisateur
            if (!isset($_GET['id'])) {
                throw new Exception('ID utilisateur manquant');
            }
            
            $id = cleanString($_GET['id']);
            $user = getUserById($pdo, $id);
            
            if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phoneNumber'])) {
                $username = cleanString($_POST['username']);
                $email = cleanString($_POST['email']);
                $phoneNumber = cleanString($_POST['phoneNumber']);
                
                $result = updateUser($pdo, $id, $username, $email, $phoneNumber);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Utilisateur mis à jour avec succès']);
                } else {
                    throw new Exception('Erreur lors de la mise à jour');
                }
            } else {
                throw new Exception('Veuillez remplir tous les champs');
            }
        } else {
            // Gestion de la création d'utilisateur
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_POST['email']) && !empty($_POST['phoneNumber'])) {
                
                $username = cleanString($_POST['username']);
                $pass = cleanString($_POST['password']);
                $passConfirm = cleanString($_POST['confirmPassword']);
                $email = cleanString($_POST['email']);
                $phoneNumber = cleanString($_POST['phoneNumber']);
                
                // Validation des données
                if (strlen($username) < 3) {
                    throw new Exception('Le nom d\'utilisateur doit contenir au moins 3 caractères');
                }
                
                if (strlen($pass) < 6) {
                    throw new Exception('Le mot de passe doit contenir au moins 6 caractères');
                }
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('L\'adresse email n\'est pas valide');
                }
                
                if ($pass !== $passConfirm) {
                    throw new Exception('Les mots de passe ne correspondent pas');
                }
                
                // Vérifier si l'utilisateur existe déjà
                $existingUser = getUser($pdo, $username, $email, $phoneNumber);
                if (!empty($existingUser)) {
                    throw new Exception('Un utilisateur avec ces informations existe déjà');
                }
                
                // Créer l'utilisateur
                date_default_timezone_set('Europe/Paris');
                $date = date('Y-m-d H:i:s', time());
                
                $result = createUser($pdo, $username, $pass, $email, $phoneNumber, $date);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Utilisateur créé avec succès']);
                } else {
                    throw new Exception('Erreur lors de la création de l\'utilisateur');
                }
                
            } else {
                throw new Exception('Veuillez remplir tous les champs');
            }
        }
        
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'errors' => [$e->getMessage()]
        ]);
    }
    exit();
} else {
    require 'View/createUser.php';
}


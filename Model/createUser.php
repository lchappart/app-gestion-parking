<?php
function getUser(PDO $pdo, string $username, string $email, string $phoneNumber)
{
    try {
        $query = 'SELECT * FROM `users` WHERE username = :username OR email = :email OR phone = :phoneNumber';
        $res = $pdo->prepare($query);
        $res->bindParam(':username', $username);
        $res->bindParam(':email', $email);
        $res->bindParam(':phoneNumber', $phoneNumber);
        $res->execute();
        return $res->fetch();
    } catch (Exception $e) {
        error_log("Erreur lors de la récupération de l'utilisateur: " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération de l'utilisateur");
    }
}

function createUser(PDO $pdo, string $username, string $pass, string $email, string $phoneNumber, string $date): bool {
    try {
        $pdo->beginTransaction();
        
        $query = 'INSERT INTO `users` (username, password, email, phone, role, status, created_at) VALUES (:username, :password, :email, :phoneNumber, :role, :status, :created_at)';
        
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
        $res = $pdo->prepare($query);
        $res->bindParam(':username', $username);
        $res->bindParam(':password', $hashedPassword);
        $res->bindParam(':email', $email);
        $res->bindParam(':phoneNumber', $phoneNumber);
        $res->bindValue(':role', '1');
        $res->bindValue(':status', '1');
        $res->bindParam(':created_at', $date);
        
        $result = $res->execute();
        
        if (!$result) {
            throw new Exception("Erreur lors de la création de l'utilisateur");
        }
        
        $pdo->commit();
        return true;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Erreur lors de la création de l'utilisateur: " . $e->getMessage());
        throw new Exception("Erreur lors de la création de l'utilisateur");
    }
}

function getUserById(PDO $pdo, string $id)
{
    try {
        $query = 'SELECT * FROM `users` WHERE id = :id';
        $res = $pdo->prepare($query);
        $res->bindParam(':id', $id);
        $res->execute();
        return $res->fetch();
    } catch (Exception $e) {
        error_log("Erreur lors de la récupération de l'utilisateur par ID: " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération de l'utilisateur");
    }
}

function updateUser(PDO $pdo, string $id, string $username, string $email, string $phoneNumber): bool {
    try {
        $pdo->beginTransaction();
        
        $query = 'UPDATE `users` SET username = :username, email = :email, phone = :phoneNumber WHERE id = :id';
        
        $res = $pdo->prepare($query);
        $res->bindParam(':id', $id);
        $res->bindParam(':username', $username);
        $res->bindParam(':email', $email);
        $res->bindParam(':phoneNumber', $phoneNumber);
        
        $result = $res->execute();
        
        if (!$result) {
            throw new Exception("Erreur lors de la mise à jour de l'utilisateur");
        }
        
        $pdo->commit();
        return true;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Erreur lors de la mise à jour de l'utilisateur: " . $e->getMessage());
        throw new Exception("Erreur lors de la mise à jour de l'utilisateur");
    }
}

function deleteUser(PDO $pdo, string $id): bool {
    try {
        $pdo->beginTransaction();
        
        $query = 'DELETE FROM `users` WHERE id = :id';
        $res = $pdo->prepare($query);
        $res->bindParam(':id', $id);
        
        $result = $res->execute();
        
        if (!$result) {
            throw new Exception("Erreur lors de la suppression de l'utilisateur");
        }
        
        $pdo->commit();
        return true;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
        throw new Exception("Erreur lors de la suppression de l'utilisateur");
    }
}
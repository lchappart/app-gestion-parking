<?php

function getUsers($pdo)
{
    $query = $pdo->query("SELECT id, username, email, phone, role, enabled , created_at FROM users");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function toggleEnabledUser($pdo, $id)
{
    try {
        $query = $pdo->prepare("UPDATE `users` SET `enabled` = NOT `enabled` WHERE `id` = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        if ($query->rowCount() > 0) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Aucune modification'];
        }
    } catch (PDOException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

function deleteUser($pdo, $id)
{
    try {
        $query = $pdo->prepare("DELETE FROM `users` WHERE `id` = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
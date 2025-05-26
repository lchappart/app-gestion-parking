<?php

function getUsers($pdo)
{
    $query = $pdo->query("SELECT id, username, email, phone, role, status, created_at FROM users");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
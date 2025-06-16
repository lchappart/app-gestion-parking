<?php
function getUser(PDO $pdo, string $username, string $email, string $phoneNumber)
{
    $query = 'SELECT * FROM `users` WHERE username = :username OR email = :email OR phone = :phoneNumber';

    $res = $pdo->prepare($query);
    $res->bindParam(':username', $username);
    $res->bindParam(':email', $email);
    $res->bindParam(':phoneNumber', $phoneNumber);
    $res->execute();
    return $res->fetch();
}

function createUser(PDO $pdo, string $username, string $pass, string $email, string $phoneNumber, string $date):void {
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
    $res->execute();
}

function getUserById(PDO $pdo, string $id)
{
    $query = 'SELECT * FROM `users` WHERE id = :id';
    $res = $pdo->prepare($query);
    $res->bindParam(':id', $id);
    $res->execute();
    return $res->fetch();
}

function updateUser(PDO $pdo, string $id, string $username, string $pass, string $email, string $phoneNumber, string $date):void {
    $query = 'UPDATE `users` SET username = :username, password = :password, email = :email, phone = :phoneNumber, role = :role, status = :status, created_at = :created_at WHERE id = :id';
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
    $res = $pdo->prepare($query);
    $res->bindParam(':id', $id);
    $res->bindParam(':username', $username);
    $res->bindParam(':password', $hashedPassword);
    $res->bindParam(':email', $email);
    $res->bindParam(':phoneNumber', $phoneNumber);
    $res->execute();
}

function deleteUser(PDO $pdo, string $id):void {
    $query = 'DELETE FROM `users` WHERE id = :id';
    $res = $pdo->prepare($query);
    $res->bindParam(':id', $id);
    $res->execute();
}
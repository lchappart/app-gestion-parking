<?php

function getUser(PDO $pdo, int $id)
{
    $query = 'SELECT * FROM `users` WHERE `id` = :id';
    $res = $pdo->prepare($query);
    $res->bindValue(':id', $id, PDO::PARAM_INT);
    $res->execute();
    return $res->fetch();
}

function editAccount(PDO $pdo, string $username, string $email, string $phone)
{
    $query = 'UPDATE `users` SET `username` = :username, `email` = :email, `phone` = :phone WHERE `id` = :id';
    $res = $pdo->prepare($query);
    $res->bindValue(':username', $username, PDO::PARAM_STR);
    $res->bindValue(':email', $email, PDO::PARAM_STR);
    $res->bindValue(':phone', $phone, PDO::PARAM_STR);
    $res->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $res->execute();
    return $res->fetch();
}

function editPassword(PDO $pdo, string $password)
{
    $query = 'UPDATE `users` SET `password` = :password WHERE `id` = :id';
    $res = $pdo->prepare($query);
    $res->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $res->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $res->execute();
    return $res->fetch();
}

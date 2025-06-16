<?php

function getPricing(PDO $pdo)
{
    $query = 'SELECT * FROM `tarifs`';
    $res = $pdo->prepare($query);
    $res->execute();
    return $res->fetchAll();
}


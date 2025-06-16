<?php

function getPricing(PDO $pdo)
{
    $query = 'SELECT * FROM `tarifs`';
    $res = $pdo->prepare($query);
    $res->execute();
    return $res->fetchAll();
}

function editPricing(PDO $pdo, string $vehicleType, int $pricing)
{
    $query = 'UPDATE `tarifs` SET `price_per_hour` = :pricing WHERE `label` = :vehicleType';
    $res = $pdo->prepare($query);
    $res->execute([':pricing' => $pricing, ':vehicleType' => $vehicleType]);
    return $res->fetchAll();
}


<?php
session_start();
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require 'Includes/functions.php';
require 'Includes/database.php';
if (isset($_GET['disconnect'])) {
    session_destroy();
    header('Location: index.php');
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    if (isset($_SESSION['auth'])) {
        if (isset($_GET['component'])) {
            $componentName = cleanString($_GET['component']);
            if (file_exists("Controller/$componentName.php")) {
                require "Controller/$componentName.php";
            }
        }
    } else if (isset($_GET['component']) && $_GET['component'] === 'createUser') {
        require 'Controller/createUser.php';
    } else {
        require "Controller/login.php";
    }
    exit();

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <base href="<?php echo $basePath; ?>">
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <title>Projet Fullstack</title>
</head>
<body>
    <?php
    if (isset($_SESSION['auth'])) {
        require '_partials/navbar.php';
        if (isset($_GET['component'])) {
            $componentName = cleanString($_GET['component']);
            if (file_exists("Controller/$componentName.php")) {
                require "Controller/$componentName.php";
            }
        }
    } else if (isset($_GET['component']) && $_GET['component'] === 'createUser') {
        require 'Controller/createUser.php';
    } else {
        require 'Controller/login.php';
    }
    ?>
</body>

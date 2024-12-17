<?php
    session_start();
    require 'Includes/database.php';
    require "Includes/functions.php";
    require __DIR__ . '/vendor/autoload.php';
    
    $errors = [];
    if (isset($_GET['logout']) && $_GET['logout']) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
    if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' )
    ){
        if (isset($_SESSION['auth']))
        {
            if (isset($_GET['component'])) {
                // MA VERSION
                // $componentName = cleanString($_GET['component']);

                $componentName = !empty($_GET['component']) ? cleanString($_GET['component']) : 'users';
                $actionName = !empty($_GET['action']) ? cleanString($_GET['action']) : null;

                if (file_exists("Controller/$componentName.php")) {
                    require "Controller/$componentName.php";
                }
            }
        } else {
            require "Controller/login.php";
        }
         exit();
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MVC</title>

        <link href="Includes/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
        <link
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
                rel="stylesheet"
        >

        <style>
            a{
                text-decoration: none !important;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <?php

                if (isset($_SESSION['auth']))
                {
                    require "_Partials/navbar.php";

                    if (isset($_GET['component'])) {
                        $componentName = cleanString($_GET['component']);
                        if (file_exists("Controller/$componentName.php")) {
                            require "Controller/$componentName.php";
                        }
                    }

                } else {
                    require "Controller/login.php";
                }

                require "_Partials/errors.php";
            ?>

        </div>

        <?php require "./_Partials/toast.html"; ?>
        <script src="Includes/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
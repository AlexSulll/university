<?php

    $dataBaseHost = "127.0.0.1";
    $dataBaseName = "oasu";
    $dataBaseUsername = "root";
    $dataBasePassword = "passbd";
    $dataBasePort = 3306;

    try {
        $pdo = new PDO("mysql:host=$dataBaseHost;dbname=$dataBaseName;port=$dataBasePort;", $dataBaseUsername, $dataBasePassword);
    } catch (PDOException $exception) {
        echo "Error: {$exception -> getMessage()}";
    }

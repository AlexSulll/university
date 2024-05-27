<?php

    $sqlConnect = ["dataBaseHost" => "127.0.0.1",
        "dataBaseName" => "oasu",
        "dataBaseUsername" => "root",
        "dataBasePassword" => "passbd",
        "dataBasePort" => 3306];

    try {
        $pdo = new PDO("mysql:host=".$sqlConnect["dataBaseHost"].";dbname=".$sqlConnect["dataBaseName"].";port=".$sqlConnect["dataBasePort"].";", $sqlConnect["dataBaseUsername"], $sqlConnect["dataBasePassword"]);
    } catch (PDOException $exception) {
        throw new Exception("Ошибка при подключении к базе данных");
    }
<?php

    header("Content-Type: application/json");

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    $facultyId = $_GET["facultyId"];
    $sql = file_get_contents(__DIR__."/../sql/department/sqlGetDepartment.sql");

    $getDepartments = $pdo->prepare($sql);
    $getDepartments->execute([$facultyId]);
    $departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($departments, JSON_UNESCAPED_UNICODE);
<?php

    header("Content-Type: application/json");

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    $departmentId = $_GET["departmentId"];
    $sql = file_get_contents(__DIR__."/../sql/department/sqlGetDepartmentId.sql");

    $getDepartment = $pdo->prepare($sql);
    $getDepartment->execute([$departmentId]);
    $department = $getDepartment->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($department, JSON_UNESCAPED_UNICODE);
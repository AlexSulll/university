<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $idDepartment = $_GET["department_id"];
    $sql = file_get_contents("sqlRequests/sqlGetDepartmentId.txt");

    $getDepartment = $pdo->prepare($sql);
    $getDepartment->execute([$idDepartment]);
    $department = $getDepartment->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($department, JSON_UNESCAPED_UNICODE);
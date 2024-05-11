<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $idFaculty = $_GET["faculty_id"];
    $sql = file_get_contents("sqlRequests/sqlGetDepartment.txt");

    $getDepartments = $pdo->prepare($sql);
    $getDepartments->execute([$idFaculty]);
    $department = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($department, JSON_UNESCAPED_UNICODE);
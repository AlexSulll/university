<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $idDepartment = $_GET["department_id"];
    $sql = file_get_contents("sqlRequests/sqlGetGroup.txt");

    $getGroups = $pdo->prepare($sql);
    $getGroups->execute([$idDepartment]);
    $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($groups, JSON_UNESCAPED_UNICODE);

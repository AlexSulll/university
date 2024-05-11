<?php

    global $pdo;
    include 'dataBase.php';

    $sql = file_get_contents("sqlRequests/sqlDepartment.txt").$_GET["faculty_id"];

    $getDepartments = $pdo->query($sql);
    $department = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($department, JSON_UNESCAPED_UNICODE);
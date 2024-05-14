<?php

    header("Content-Type: application/json");

    global $pdo;
    include "../thesaurus/dataBase.php";

    $idDepartment = $_GET["departmentId"];
    $sql = file_get_contents("../sql/department/sqlGetDepartmentId.sql");

    $getDepartment = $pdo->prepare($sql);
    $getDepartment->execute([$idDepartment]);
    $department = $getDepartment->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($department, JSON_UNESCAPED_UNICODE);
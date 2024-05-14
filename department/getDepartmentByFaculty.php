<?php

    header("Content-Type: application/json");

    global $pdo;
    include "../thesaurus/dataBase.php";

    $idFaculty = $_GET["facultyId"];
    $sql = file_get_contents("../sql/department/sqlGetDepartment.sql");

    $getDepartments = $pdo->prepare($sql);
    $getDepartments->execute([$idFaculty]);
    $department = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($department, JSON_UNESCAPED_UNICODE);
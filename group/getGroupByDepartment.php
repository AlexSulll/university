<?php

    header("Content-Type: application/json");

    global $pdo;
    include "../thesaurus/dataBase.php";

    $idDepartment = $_GET["departmentId"];
    $sql = file_get_contents("../sql/group/sqlGetGroup.sql");

    $getGroups = $pdo->prepare($sql);
    $getGroups->execute([$idDepartment]);
    $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($groups, JSON_UNESCAPED_UNICODE);

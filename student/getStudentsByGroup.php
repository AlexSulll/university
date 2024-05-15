<?php

    header("Content-Type: application/json");

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    $idGroup = $_GET["groupId"];
    $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudents.sql");

    $getStudents = $pdo->prepare($sql);
    $getStudents->execute([$idGroup]);
    $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students, JSON_UNESCAPED_UNICODE);
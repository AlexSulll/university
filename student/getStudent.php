<?php

    header("Content-Type: application/json");

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    $idStudent = $_GET["studentId"];
    $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudentId.sql");

    $getStudent = $pdo->prepare($sql);
    $getStudent->execute([$idStudent]);
    $student = $getStudent->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($student, JSON_UNESCAPED_UNICODE);
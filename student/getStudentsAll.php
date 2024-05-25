<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once dirname(__DIR__) . "/thesaurus/dataBase.php";

    $sql = file_get_contents(dirname(__DIR__) . "/sql/students/getStudentsAll.sql");

    $getStudents = $pdo->query($sql);
    $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students, JSON_UNESCAPED_UNICODE);
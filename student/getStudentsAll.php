<?php

    header("Content-Type: application/json");

    global $pdo;
    include "../thesaurus/dataBase.php";

    $sql = file_get_contents("../sql/students/sqlGetStudentsAll.sql");

    $getStudents = $pdo->query($sql);
    $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students, JSON_UNESCAPED_UNICODE);
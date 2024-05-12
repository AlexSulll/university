<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $sql = file_get_contents('sqlRequests/sqlGetStudentsAll.txt');

    $getStudents = $pdo->query($sql);
    $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students, JSON_UNESCAPED_UNICODE);
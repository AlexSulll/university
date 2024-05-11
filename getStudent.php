<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $idStudent = $_GET['student_id'];
    $sql = file_get_contents('sqlRequests/sqlGetStudentId.txt');

    $getStudent = $pdo->prepare($sql);
    $getStudent->execute([$idStudent]);
    $student = $getStudent->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($student, JSON_UNESCAPED_UNICODE);
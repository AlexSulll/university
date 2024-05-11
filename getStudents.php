<?php

    global $pdo;
    include 'dataBase.php';

    $idGroup = $_GET['group_id'];
    $sql = file_get_contents('sqlRequests/sqlGetStudent.txt');

    $getStudents = $pdo->prepare($sql);
    $getStudents->execute([$idGroup]);
    $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students, JSON_UNESCAPED_UNICODE);
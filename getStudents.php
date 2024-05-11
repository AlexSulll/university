<?php

    global $pdo;
    include 'dataBase.php';

    $sql = file_get_contents('sqlRequests/sqlStudent.txt').$_GET['group_id'];

    $getStudents = $pdo->query($sql);
    $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($students, JSON_UNESCAPED_UNICODE);
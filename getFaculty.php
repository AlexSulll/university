<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $facultyId = $_GET['faculty_id'];
    $sql = file_get_contents('sqlRequests/sqlGetFacultyId.txt');

    $getFaculty = $pdo->prepare($sql);
    $getFaculty->execute([$facultyId]);
    $faculties = $getFaculty->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($faculties,JSON_UNESCAPED_UNICODE);
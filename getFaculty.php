<?php

    global $pdo;
    include 'dataBase.php';

    $sql = file_get_contents('sqlRequests/sqlFaculty.txt');

    $getFaculties = $pdo->query($sql);
    $faculties = $getFaculties->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($faculties,JSON_UNESCAPED_UNICODE);
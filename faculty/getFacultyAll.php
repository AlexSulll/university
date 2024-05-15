<?php

    header("Content-Type: application/json");

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    $sql = file_get_contents(__DIR__."/../sql/faculty/sqlGetFaculty.sql");

    $getFaculties = $pdo->query($sql);
    $faculties = $getFaculties->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($faculties,JSON_UNESCAPED_UNICODE);
<?php

    header("Content-Type: application/json");

    global $pdo;
    include "../thesaurus/dataBase.php";

    $facultyId = $_GET["facultyId"];
    $sql = file_get_contents("../sql/faculty/sqlGetFacultyId.sql");

    $getFaculty = $pdo->prepare($sql);
    $getFaculty->execute([$facultyId]);
    $faculties = $getFaculty->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($faculties,JSON_UNESCAPED_UNICODE);
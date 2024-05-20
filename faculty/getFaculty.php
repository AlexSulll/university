<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["facultyId"])) {
        $faculty = getFaculty($_GET["facultyId"]);
        if ($faculty) {
            echo $faculty;
        } else {
            echo json_encode("Такого факультета не существует", JSON_THROW_ON_ERROR);
        }
    }

    function getFaculty(int $facultyId): ?string
    {
        global $pdo;
        $sql = file_get_contents(__DIR__ . "/../sql/faculty/getFacultyId.sql");

        $getFaculty = $pdo->prepare($sql);
        $getFaculty->execute([$facultyId]);
        $faculties = $getFaculty->fetchAll(PDO::FETCH_ASSOC);

        if ($faculties) {
            return json_encode($faculties,JSON_UNESCAPED_UNICODE);
        } else {
            return null;
        }
    }
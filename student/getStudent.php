<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["studentId"])) {
        $student = getStudent($_GET["studentId"]);
        if ($student) {
            echo $student;
        } else {
            echo json_encode("Такого студента не существует", JSON_UNESCAPED_UNICODE);
        }
    }

    function getStudent(int $studentId): ?string
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudentId.sql");

        $getStudent = $pdo->prepare($sql);
        $getStudent->execute([$studentId]);
        $student = $getStudent->fetchAll(PDO::FETCH_ASSOC);

        if ($student) {
            return json_encode($student, JSON_UNESCAPED_UNICODE);
        } else {
            return null;
        }
    }

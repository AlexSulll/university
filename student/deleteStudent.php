<?php

    require_once __DIR__."/../thesaurus/dataBase.php";
    global $pdo;

    if (isset($_GET["studentId"])) {
        $studentId = $_GET["studentId"];
        $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudentId.sql");
        $getStudent = $pdo->prepare($sql);
        $getStudent->execute([$studentId]);
        if ($getStudent->fetch()){
            deleteStudent($studentId);
        } else {
            echo json_encode("Такого студента не существует",JSON_UNESCAPED_UNICODE);
        }
    }

    function deleteStudent(int $studentId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/students/sqlDeleteStudent.sql");
        $deleteStudent = $pdo->prepare($sql);
        $deleteStudent->execute([$studentId]);
    }

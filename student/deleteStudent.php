<?php

    require_once dirname(__DIR__) . "/thesaurus/dataBase.php";
    global $pdo;

    if (isset($_POST["studentId"])) {
        $studentId = $_POST["studentId"];
        $sql = file_get_contents(dirname(__DIR__) . "/sql/students/getStudentId.sql");
        $getStudent = $pdo->prepare($sql);
        $getStudent->execute([$studentId]);
        if ($getStudent->fetch()){
            deleteStudent($studentId);
        } else {
            echo json_encode("Такого студента не существует",JSON_THROW_ON_ERROR);
        }
    }

    function deleteStudent(int $studentId): void
    {
        global $pdo;
        $sql = file_get_contents(dirname(__DIR__) . "/sql/students/deleteStudent.sql");
        $deleteStudent = $pdo->prepare($sql);
        $deleteStudent->execute([$studentId]);
    }

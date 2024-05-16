<?php

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["studentId"]) && isset($_POST["newNameStudent"]) && isset($_POST["newGroupStudentId"])) {
        $studentId = $_POST["studentId"];
        $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudentId.sql");
        $getStudent = $pdo->prepare($sql);
        $getStudent->execute([$studentId]);
        if ($getStudent->fetch()) {
            $newNameStudent = $_POST["newNameStudent"];
            $newGroupStudentId = $_POST["newGroupStudentId"];

            $sql = file_get_contents(__DIR__."/../sql/students/sqlEditStudent.sql");
            $editStudent = $pdo->prepare($sql);
            $editStudent->execute([
                "newNameStudent" => $newNameStudent,
                "newGroupStudentId" => $newGroupStudentId,
                "studentId" => $studentId
            ]);
        } else {
            echo json_encode("Такого студента не существует", JSON_UNESCAPED_UNICODE);
        }
    }

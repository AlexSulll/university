<?php

    global $pdo;
    include "../thesaurus/dataBase.php";

    if (isset($_POST["studentId"])) {
        $studentId = $_POST["studentId"];
        $newNameStudent = $_POST["newNameStudent"];
        $newGroupStudentId = $_POST["newGroupStudentId"];

        $sql = file_get_contents("../sql/students/sqlEditStudent.sql");
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            "newNameStudent" => $newNameStudent,
            "newGroupStudentId" => $newGroupStudentId,
            "studentId" => $studentId
        ]);
    }

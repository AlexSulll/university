<?php

    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["studentId"])) {
        deleteStudent($_GET["studentId"]);
    }

    function deleteStudent(int $idStudent): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/students/sqlDeleteStudent.sql");
        $deleteStudent = $pdo->prepare($sql);
        $deleteStudent->execute([$idStudent]);
    }

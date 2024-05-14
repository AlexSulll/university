<?php

    include "../thesaurus/dataBase.php";

    if (isset($_GET["studentId"])) {
        deleteStudent($_GET["studentId"]);
    }

    function deleteStudent(int $idStudent): void
    {
        global $pdo;
        $sql = file_get_contents("../sql/students/sqlDeleteStudent.sql");
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idStudent]);
    }

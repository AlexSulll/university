<?php

    global $pdo;
    include "../thesaurus/dataBase.php";

    if (isset($_POST["facultyId"])) {
        $facultyId = $_POST["facultyId"];
        $newNameFaculty = $_POST["newNameFaculty"];

        $sql = file_get_contents("../sql/faculty/sqlEditFaculty.sql");
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            "newNameFaculty" => $newNameFaculty,
            "facultyId" => $facultyId
        ]);
    }


<?php

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["facultyId"])) {
        $facultyId = $_POST["facultyId"];
        $newNameFaculty = $_POST["newNameFaculty"];

        $sql = file_get_contents(__DIR__."/../sql/faculty/sqlEditFaculty.sql");
        $editFaculty = $pdo->prepare($sql);
        $editFaculty->execute([
            "newNameFaculty" => $newNameFaculty,
            "facultyId" => $facultyId
        ]);
    }


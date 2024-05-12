<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['facultyId'])) {
        $facultyId = $_POST['facultyId'];
        $newNameFaculty = $_POST['newNameFaculty'];

        $sql = file_get_contents('sqlRequests/sqlEditFaculty.txt');
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            'newNameFaculty' => $newNameFaculty,
            'facultyId' => $facultyId
        ]);
    }


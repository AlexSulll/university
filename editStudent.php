<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['studentId'])) {
        $studentId = $_POST['studentId'];
        $newNameStudent = $_POST['newNameStudent'];
        $newGroupStudentId = $_POST['newGroupStudentId'];

        $sql = file_get_contents('sqlRequests/sqlEditStudent.txt');
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            'newNameStudent' => $newNameStudent,
            'newGroupStudentId' => $newGroupStudentId,
            'studentId' => $studentId
        ]);
    }

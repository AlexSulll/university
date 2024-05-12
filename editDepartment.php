<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['departmentId'])) {
        $departmentId = $_POST['departmentId'];
        $newNameDepartment = $_POST['newNameDepartment'];
        $newFacultyId = $_POST['newFacultyId'];

        $sql = file_get_contents('sqlRequests/sqlEditDepartment.txt');
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            'newNameDepartment' => $newNameDepartment,
            'newFacultyId' => $newFacultyId,
            'departmentId' => $departmentId
        ]);
    }
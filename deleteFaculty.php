<?php

    include 'deleteDepartment.php';

    if (isset($_GET['faculty_id'])) {
        deleteFaculty($_GET['faculty_id']);
    }

    function deleteFaculty($idFaculty)
    {
        global $pdo;
        $sql = file_get_contents("sqlRequests/sqlGetDepartment.txt");
        $getDepartments = $pdo->prepare($sql);
        $getDepartments->execute([$idFaculty]);
        $departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

        foreach ($departments as $department) {
            deleteDepartment($department['department_id']);
        }

        $sql = file_get_contents('sqlRequests/sqlDeleteFaculty.txt');
        $delFaculty = $pdo->prepare($sql);
        $delFaculty->execute([$idFaculty]);
    }
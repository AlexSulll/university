<?php

    include "../department/deleteDepartment.php";

    if (isset($_GET["facultyId"])) {
        deleteFaculty($_GET["facultyId"]);
    }

    function deleteFaculty(int $idFaculty): void
    {
        global $pdo;
        $sql = file_get_contents("../sql/department/sqlGetDepartment.sql");
        $getDepartments = $pdo->prepare($sql);
        $getDepartments->execute([$idFaculty]);
        $departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

        foreach ($departments as $department) {
            deleteDepartment($department["department_id"]);
        }

        $sql = file_get_contents("../sql/faculty/sqlDeleteFaculty.sql");
        $delFaculty = $pdo->prepare($sql);
        $delFaculty->execute([$idFaculty]);
    }
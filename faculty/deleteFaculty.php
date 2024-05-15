<?php

    require_once __DIR__."/../department/deleteDepartment.php";

    if (isset($_GET["facultyId"])) {
        deleteFaculty($_GET["facultyId"]);
    }

    function deleteFaculty(int $facultyId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/department/sqlGetDepartment.sql");
        $getDepartments = $pdo->prepare($sql);
        $getDepartments->execute([$facultyId]);
        $departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

        foreach ($departments as $department) {
            deleteDepartment($department["department_id"]);
        }

        $sql = file_get_contents(__DIR__."/../sql/faculty/sqlDeleteFaculty.sql");
        $deleteFaculty = $pdo->prepare($sql);
        $deleteFaculty->execute([$facultyId]);
    }
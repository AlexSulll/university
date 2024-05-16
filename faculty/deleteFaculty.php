<?php

    require_once __DIR__."/../department/deleteDepartment.php";
    global $pdo;

    if (isset($_GET["facultyId"])) {
        $facultyId = $_GET["facultyId"];
        $sql = file_get_contents(__DIR__."/../sql/faculty/sqlGetFacultyId.sql");
        $getFaculty = $pdo->prepare($sql);
        $getFaculty->execute([$facultyId]);
        if ($getFaculty->fetch()) {
            deleteFaculty($facultyId);
        } else {
            echo json_encode("Такого факультета не сущесвтует", JSON_UNESCAPED_UNICODE);
        }

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
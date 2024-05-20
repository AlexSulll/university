<?php

    require_once __DIR__."/../department/deleteDepartment.php";
    global $pdo;

    if (isset($_POST["facultyId"])) {
        $facultyId = $_POST["facultyId"];
        $sql = file_get_contents(__DIR__ . "/../sql/faculty/getFacultyId.sql");
        $getFaculty = $pdo->prepare($sql);
        $getFaculty->execute([$facultyId]);
        if ($getFaculty->fetch()) {
            deleteFaculty($facultyId);
        } else {
            echo json_encode("Такого факультета не сущесвтует", JSON_THROW_ON_ERROR);
        }

    }

    function deleteFaculty(int $facultyId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__ . "/../sql/department/getDepartment.sql");
        $getDepartments = $pdo->prepare($sql);
        $getDepartments->execute([$facultyId]);
        $departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

        foreach ($departments as $department) {
            deleteDepartment($department["department_id"]);
        }

        $sql = file_get_contents(__DIR__ . "/../sql/faculty/deleteFaculty.sql");
        $deleteFaculty = $pdo->prepare($sql);
        $deleteFaculty->execute([$facultyId]);
    }
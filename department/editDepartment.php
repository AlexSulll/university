<?php

    global $pdo;
    include "../thesaurus/dataBase.php";

    if (isset($_POST["departmentId"])) {
        $departmentId = $_POST["departmentId"];
        $newNameDepartment = $_POST["newNameDepartment"];
        $newFacultyId = $_POST["newFacultyId"];

        $sql = file_get_contents("../sql/department/sqlEditDepartment.sql");
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            "newNameDepartment" => $newNameDepartment,
            "newFacultyId" => $newFacultyId,
            "departmentId" => $departmentId
        ]);
    }
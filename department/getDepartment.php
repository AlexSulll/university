<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["departmentId"])) {
        $department = getDepartment($_GET["departmentId"]);
        if ($department) {
            echo $department;
        } else {
            echo json_encode("Такой кафедры не существует", JSON_UNESCAPED_UNICODE);
        }
    }

    function getDepartment(int $departmentId): ?string
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/department/sqlGetDepartmentId.sql");

        $getDepartment = $pdo->prepare($sql);
        $getDepartment->execute([$departmentId]);
        $department = $getDepartment->fetchAll(PDO::FETCH_ASSOC);

        if ($department) {
            return json_encode($department, JSON_UNESCAPED_UNICODE);
        } else {
            return null;
        }
    }
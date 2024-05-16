<?php

    require_once __DIR__."/../group/deleteGroup.php";
    global $pdo;

    if (isset($_GET["departmentId"])) {
        $departmentId = $_GET["departmentId"];
        $sql = file_get_contents(__DIR__."/../sql/department/sqlGetDepartmentId.sql");
        $getDepartment = $pdo->prepare($sql);
        $getDepartment->execute([$departmentId]);
        if ($getDepartment->fetch()){
            deleteDepartment($departmentId);
        } else {
            echo json_encode("Такой кафедры не существует", JSON_UNESCAPED_UNICODE);
        }
    }

    function deleteDepartment(int $departmentId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/group/sqlGetGroup.sql");
        $getGroups = $pdo->prepare($sql);
        $getGroups->execute([$departmentId]);
        $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

        foreach ($groups as $group) {
            deleteGroup($group["group_id"]);
        }

        $sql = file_get_contents(__DIR__."/../sql/department/sqlDeleteDepartment.sql");
        $deleteDepartment = $pdo->prepare($sql);
        $deleteDepartment->execute([$departmentId]);
    }
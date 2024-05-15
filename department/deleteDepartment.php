<?php

    require_once __DIR__."/../group/deleteGroup.php";

    if (isset($_GET["departmentId"])) {
        deleteDepartment($_GET["departmentId"]);
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
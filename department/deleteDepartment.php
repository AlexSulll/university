<?php

    require_once "../group/deleteGroup.php";

    if (isset($_GET["departmentId"])) {
        deleteDepartment($_GET["departmentId"]);
    }

    function deleteDepartment(int $idDepartment): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."../sql/group/sqlGetGroup.sql");
        $getGroups = $pdo->prepare($sql);
        $getGroups->execute([$idDepartment]);
        $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

        foreach ($groups as $group) {
            deleteGroup($group["group_id"]);
        }

        $sql = file_get_contents("../sql/department/sqlDeleteDepartment.sql");
        $delDepartment = $pdo->prepare($sql);
        $delDepartment->execute([$idDepartment]);
    }
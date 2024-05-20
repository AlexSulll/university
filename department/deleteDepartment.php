<?php

    require_once __DIR__."/../group/deleteGroup.php";
    global $pdo;

    if (isset($_POST["departmentId"])) {
        $departmentId = $_POST["departmentId"];
        $sql = file_get_contents(__DIR__ . "/../sql/department/getDepartmentId.sql");
        $getDepartment = $pdo->prepare($sql);
        $getDepartment->execute([$departmentId]);
        if ($getDepartment->fetch()){
            deleteDepartment($departmentId);
        } else {
            echo json_encode("Такой кафедры не существует", JSON_THROW_ON_ERROR);
        }
    }

    function deleteDepartment(int $departmentId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__ . "/../sql/group/getGroup.sql");
        $getGroups = $pdo->prepare($sql);
        $getGroups->execute([$departmentId]);
        $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

        foreach ($groups as $group) {
            deleteGroup($group["group_id"]);
        }

        $sql = file_get_contents(__DIR__ . "/../sql/department/deleteDepartment.sql");
        $deleteDepartment = $pdo->prepare($sql);
        $deleteDepartment->execute([$departmentId]);
    }
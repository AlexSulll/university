<?php

    include 'deleteGroup.php';

    if (isset($_GET['departmentId'])) {
        deleteDepartment($_GET['departmentId']);
    }

    function deleteDepartment($idDepartment)
    {
        global $pdo;
        $sql = file_get_contents("sqlRequests/sqlGetGroup.txt");
        $getGroups = $pdo->prepare($sql);
        $getGroups->execute([$idDepartment]);
        $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

        foreach ($groups as $group) {
            deleteGroup($group['group_id']);
        }

        $sql = file_get_contents('sqlRequests/sqlDeleteDepartment.txt');
        $delDepartment = $pdo->prepare($sql);
        $delDepartment->execute([$idDepartment]);
    }
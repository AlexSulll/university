<?php

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["groupId"])) {
        $groupId = $_POST["groupId"];
        $newNameGroup = $_POST["newNameGroup"];
        $newDepartmentId = $_POST["newDepartmentId"];

        $sql = file_get_contents(__DIR__."/../sql/group/sqlEditGroup.sql");
        $editGroup = $pdo->prepare($sql);
        $editGroup->execute([
            "newNameGroup" => $newNameGroup,
            "newDepartmentId" => $newDepartmentId,
            "groupId" => $groupId
        ]);
    }

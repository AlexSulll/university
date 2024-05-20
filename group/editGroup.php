<?php

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["groupId"], $_POST["newNameGroup"], $_POST["newDepartmentId"])) {
        $groupId = $_POST["groupId"];
        $newNameGroup = $_POST["newNameGroup"];
        $newDepartmentId = $_POST["newDepartmentId"];

        $sqlGroupId = file_get_contents(__DIR__."/../sql/group/getGroupId.sql");
        $getGroup = $pdo->prepare($sqlGroupId);
        $getGroup->execute([$groupId]);

        $sqlGroupAll = file_get_contents(__DIR__."/../sql/group/getGroupAll.sql");
        $getGroupAll = $pdo->query($sqlGroupAll);
        $groups = $getGroupAll->fetchAll(PDO::FETCH_ASSOC);

        $sqlDepartmentGroupId = file_get_contents(__DIR__."/../sql/department/getDepartmentId.sql");
        $getDepartment = $pdo->prepare($sqlDepartmentGroupId);
        $getDepartment->execute([$newDepartmentId]);

        if ($getGroup->fetch()) {
            if ($getDepartment->fetch()) {
                if (!array_search($newNameGroup, array_column($groups, "name_of_group"))) {

                    $sql = file_get_contents(__DIR__ . "/../sql/group/editGroup.sql");
                    $editGroup = $pdo->prepare($sql);
                    $editGroup->execute([
                        "newNameGroup" => $newNameGroup,
                        "newDepartmentId" => $newDepartmentId,
                        "groupId" => $groupId
                    ]);

                    echo json_encode("Успешное изменение группы", JSON_UNESCAPED_UNICODE);

                } else {
                    echo json_encode("Группа с таким названием уже существует", JSON_THROW_ON_ERROR);
                }
            } else {
                echo json_encode("Такой кафедры не существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Такой группы не существует", JSON_THROW_ON_ERROR);
        }
    } else {
        echo json_encode("Ошибка данных",JSON_THROW_ON_ERROR);
    }
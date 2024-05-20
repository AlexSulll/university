<?php

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";
    require_once __DIR__."/../department/getDepartment.php";

    if (isset($_POST["groupName"], $_POST["departmentId"])) {
        $groupName = $_POST["groupName"];
        $departmentId = $_POST["departmentId"];
        if (preg_match("/^[А-яЁё0-9 -]*$/u", $groupName) && preg_match("/^[0-9]*$/", $departmentId)) {
            if (getDepartment($departmentId)) {
                $sql = file_get_contents(__DIR__ . "/../sql/group/addGroup.sql");
                $addGroup = $pdo->prepare($sql);
                $addGroup->execute([
                    "groupName" => $groupName,
                    "departmentId" => $departmentId
                ]);
                echo json_encode("Успешное добавление группы", JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode("Такая кафедра не существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Ошибка при проверке данных", JSON_THROW_ON_ERROR);
        }
    }
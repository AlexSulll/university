<?php

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["nameGroup"]) && isset($_POST["departmentId"])) {
        if (preg_match("/^[А-яЁё0-9 -]*$/u", $_POST["nameGroup"]) && preg_match("/^[0-9]*$/", $_POST["departmentId"])) {
            $nameGroup = $_POST["nameGroup"];
            $departmentId = $_POST["departmentId"];

            $sql = file_get_contents(__DIR__."/../sql/group/sqlAddGroup.sql");
            $addGroup = $pdo->prepare($sql);

            try {
                $addGroup->execute([
                    "nameGroup" => $nameGroup,
                    "departmentGroup" => $departmentId
                ]);
            } catch (PDOException $exception) {
                throw new exception("Ошибка при добавлении нового факультета");
            }
        } else {
            throw new exception("Ошибка при проверке данных");
        }
    } else {
        throw new exception("Необходимо заполнить все поля");
    }

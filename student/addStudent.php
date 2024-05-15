<?php

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["nameStudent"]) && isset($_POST["groupId"])) {
        if (preg_match("/^[А-яЁё -]*$/u", $_POST["nameStudent"]) && preg_match("/^[0-9]*$/", $_POST["groupId"])) {
            $nameStudent = $_POST["nameStudent"];
            $groupId = $_POST["groupId"];

            $sql = file_get_contents(__DIR__."/../sql/students/sqlAddStudent.sql");
            $addStudent = $pdo->prepare($sql);

            try {
                $addStudent->execute([
                    "nameStudent" => $nameStudent,
                    "groupStudent" => $groupId
                ]);
            } catch (PDOException $exception) {
                throw new exception("Ошибка при добавлении нового студента");
            }
        } else {
            throw new exception("Ошибка при проверке данных");
        }
    } else {
        throw new exception("Необходимо заполнить все поля");
    }

<?php

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";
    require_once __DIR__."/../group/getGroup.php";

    if (isset($_POST["studentName"], $_POST["groupId"])) {
        $groupId = $_POST["groupId"];
        $studentName = $_POST["studentName"];
        if (preg_match("/^[А-яЁё -]*$/u", $studentName) && preg_match("/^[0-9]*$/", $groupId)) {
            if (getGroup($groupId)) {
                $sql = file_get_contents(__DIR__ . "/../sql/students/addStudent.sql");
                $addStudent = $pdo->prepare($sql);
                $addStudent->execute([
                    "studentName" => $studentName,
                    "groupId" => $groupId
                ]);
                echo json_encode("Успешное добавление студента", JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode("Такой группы не существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Ошибка при проверке данных", JSON_THROW_ON_ERROR);
        }
    }
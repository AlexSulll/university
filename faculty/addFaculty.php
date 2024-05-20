<?php

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["facultyName"])) {
        $facultyName = $_POST["facultyName"];
        if (preg_match("/^[А-яЁё -]*$/u", $facultyName)) {

            $sql = file_get_contents(__DIR__ . "/../sql/faculty/addFaculty.sql");
            $addFaculty = $pdo->prepare($sql);
            $addFaculty->execute([
                "facultyName" => $facultyName
            ]);
            echo json_encode("Успешное добавление факультета", JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Ошибка при проверке данных", JSON_THROW_ON_ERROR);
        }
    }

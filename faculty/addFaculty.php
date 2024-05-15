<?php

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["facultyName"])) {
        if (preg_match("/^[А-яЁё -]*$/u", $_POST["facultyName"])) {
            $facultyName = $_POST["facultyName"];

            $sql = file_get_contents(__DIR__."/../sql/faculty/sqlAddFaculty.sql");
            $addFaculty = $pdo->prepare($sql);

            try {
                $addFaculty->execute([
                    "facultyName" => $facultyName
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

<?php

    global $pdo;
    include "../thesaurus/dataBase.php";

    if (isset($_POST["nameFaculty"])) {
        if (preg_match("/^[А-яЁё -]*$/u", $_POST["nameFaculty"])) {
            $nameFaculty = $_POST["nameFaculty"];

            $sql = file_get_contents("../sql/faculty/sqlAddFaculty.sql");
            $addStudent = $pdo->prepare($sql);

            try {
                $addStudent->execute([
                    "nameFaculty" => $nameFaculty
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

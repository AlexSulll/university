<?php

    global $pdo;
    include "../thesaurus/dataBase.php";

    if (isset($_POST["departmentName"]) && isset($_POST["facultyId"])) {
        if (preg_match("/^[А-яЁё -]*$/u", $_POST["departmentName"]) && preg_match("/^[0-9]*$/", $_POST["facultyId"])) {
            $nameDepartment = $_POST["departmentName"];
            $facultyId = $_POST["facultyId"];

            $sql = file_get_contents("../sql/department/sqlAddDepartment.sql");
            $addStudent = $pdo->prepare($sql);

            try {
                $addStudent->execute([
                    "departmentName" => $nameDepartment,
                    "facultyId" => $facultyId
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
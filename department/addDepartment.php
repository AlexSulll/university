<?php

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["departmentName"]) && isset($_POST["facultyId"])) {
        if (preg_match("/^[А-яЁё -]*$/u", $_POST["departmentName"]) && preg_match("/^[0-9]*$/", $_POST["facultyId"])) {
            $departmentName = $_POST["departmentName"];
            $facultyId = $_POST["facultyId"];

            $sql = file_get_contents(__DIR__."/../sql/department/sqlAddDepartment.sql");
            $addDepartment = $pdo->prepare($sql);

            try {
                $addDepartment->execute([
                    "departmentName" => $departmentName,
                    "facultyId" => $facultyId
                ]);
            } catch (PDOException $exception) {
                throw new exception("Ошибка при добавлении нового факультета");
            }
            echo json_encode("Успешное добавление кафедры",JSON_UNESCAPED_UNICODE);
        } else {
            die('{"success":false}');
        }
    }
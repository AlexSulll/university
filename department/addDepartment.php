<?php

    global $pdo;
    require_once dirname(__DIR__) . "/thesaurus/dataBase.php";
    require_once dirname(__DIR__) . "/faculty/getFaculty.php";

    if (isset($_POST["departmentName"], $_POST["facultyId"])) {
        $departmentName = $_POST["departmentName"];
        $facultyId = $_POST["facultyId"];
        if (preg_match("/^[А-яЁё -]*$/u", $departmentName) && preg_match("/^[0-9]*$/", $facultyId)) {
            if (getFaculty($facultyId)) {
                $sql = file_get_contents(dirname(__DIR__) . "/sql/department/addDepartment.sql");
                $addDepartment = $pdo->prepare($sql);
                $addDepartment->execute([
                    "departmentName" => $departmentName,
                    "facultyId" => $facultyId
                ]);
                echo json_encode("Успешное добавление кафедры",JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode("Такой факультет не существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Ошибка при проверке данных",JSON_THROW_ON_ERROR);
        }
    }
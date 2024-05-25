<?php

    global $pdo;
    require_once dirname(__DIR__) . "/thesaurus/dataBase.php";

    if (isset($_POST["departmentId"], $_POST["newNameDepartment"], $_POST["newFacultyId"])) {
        $departmentId = $_POST["departmentId"];
        $newNameDepartment = $_POST["newNameDepartment"];
        $newFacultyId = $_POST["newFacultyId"];

        $sqlDepartmentId = file_get_contents(dirname(__DIR__) . "/sql/department/getDepartmentId.sql");
        $getDepartment = $pdo->prepare($sqlDepartmentId);
        $getDepartment->execute([$departmentId]);

        $sqlDepartmentAll = file_get_contents(dirname(__DIR__) . "/sql/department/getDepartmentAll.sql");
        $getDepartmentAll = $pdo->query($sqlDepartmentAll);
        $departments = $getDepartmentAll->fetchAll(PDO::FETCH_ASSOC);

        $sqlFacultyId = file_get_contents(dirname(__DIR__) . "/sql/faculty/getFacultyId.sql");
        $getFacultyDepartment = $pdo->prepare($sqlFacultyId);
        $getFacultyDepartment->execute([$newFacultyId]);

        if ($getDepartment->fetch()) {
            if ($getFacultyDepartment->fetch()) {
                if (!array_search($newNameDepartment, array_column($departments, "name_of_department"))) {

                    $sql = file_get_contents(dirname(__DIR__) . "/sql/department/editDepartment.sql");
                    $editStudent = $pdo->prepare($sql);
                    $editStudent->execute([
                        "newNameDepartment" => $newNameDepartment,
                        "newFacultyId" => $newFacultyId,
                        "departmentId" => $departmentId
                    ]);

                    echo json_encode("Успешное изменение кафедры", JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode("Кафедра с таким названием уже существует", JSON_THROW_ON_ERROR);
                }
            } else {
                echo json_encode("Такого факультета не существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Такой кафедры не существует", JSON_THROW_ON_ERROR);
        }
    } else {
        echo json_encode("Ошибка данных",JSON_THROW_ON_ERROR);
    }
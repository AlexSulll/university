<?php

    global $pdo;
    require_once dirname(__DIR__) . "/thesaurus/dataBase.php";

    if (isset($_POST["studentId"], $_POST["newNameStudent"], $_POST["newGroupStudentId"])) {
        $studentId = $_POST["studentId"];
        $newNameStudent = $_POST["newNameStudent"];
        $newGroupStudentId = $_POST["newGroupStudentId"];

        $sqlStudentId = file_get_contents(dirname(__DIR__) . "/sql/students/getStudentId.sql");
        $getStudent = $pdo->prepare($sqlStudentId);
        $getStudent->execute([$studentId]);

        $sqlStudentAll = file_get_contents(dirname(__DIR__) . "/sql/students/getStudentsAll.sql");
        $getStudentAll = $pdo->query($sqlStudentAll);
        $students = $getStudentAll->fetchAll(PDO::FETCH_ASSOC);

        $sqlGroupStudentId = file_get_contents(dirname(__DIR__) . "/sql/group/getGroupId.sql");
        $getGroupStudent = $pdo->prepare($sqlGroupStudentId);
        $getGroupStudent->execute([$newGroupStudentId]);

        if ($getStudent->fetch()) {
            if ($getGroupStudent->fetch()) {
                if (!array_search($newNameStudent, array_column($students, "name_of_student"))) {

                    $sql = file_get_contents(dirname(__DIR__) . "/sql/students/editStudent.sql");
                    $editStudent = $pdo->prepare($sql);
                    $editStudent->execute([
                        "newNameStudent" => $newNameStudent,
                        "newGroupStudentId" => $newGroupStudentId,
                        "studentId" => $studentId
                    ]);

                    echo json_encode("Успешное изменение студента", JSON_UNESCAPED_UNICODE);

                } else {
                    echo json_encode("Студент с таким именем уже существует", JSON_THROW_ON_ERROR);
                }
            } else {
                echo json_encode("Такой группы не существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Такого студента не существует", JSON_THROW_ON_ERROR);
        }
    } else {
        echo json_encode("Ошибка данных",JSON_THROW_ON_ERROR);
    }
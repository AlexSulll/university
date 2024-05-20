<?php

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_POST["facultyId"], $_POST["newNameFaculty"])) {
        $facultyId = $_POST["facultyId"];
        $newNameFaculty = $_POST["newNameFaculty"];

        $sqlFacultyId = file_get_contents(__DIR__ . "/../sql/faculty/getFacultyId.sql");
        $getFaculty = $pdo->prepare($sqlFacultyId);
        $getFaculty->execute([$facultyId]);

        $sqlFacultyAll = file_get_contents(__DIR__ . "/../sql/faculty/getFaculty.sql");
        $getFacultyAll = $pdo->query($sqlFacultyAll);
        $faculties = $getFacultyAll->fetchAll(PDO::FETCH_ASSOC);

        if ($getFaculty->fetch()) {
            if (!array_search($newNameFaculty, array_column($faculties, "name_faculty"))) {
                $sql = file_get_contents(__DIR__ . "/../sql/faculty/editFaculty.sql");
                $editFaculty = $pdo->prepare($sql);
                $editFaculty->execute([
                    "newNameFaculty" => $newNameFaculty,
                    "facultyId" => $facultyId
                ]);

                echo json_encode("Успешное изменение факультета", JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode("Факультет с таким названием уже существует", JSON_THROW_ON_ERROR);
            }
        } else {
            echo json_encode("Такого факультета не существует", JSON_THROW_ON_ERROR);
        }
    } else {
        echo json_encode("Ошибка данных",JSON_THROW_ON_ERROR);
    }
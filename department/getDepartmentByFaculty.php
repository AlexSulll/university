<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["facultyId"])) {
        $facultyId = $_GET["facultyId"];
        $sql = file_get_contents(__DIR__ . "/../sql/department/getDepartment.sql");

        $getDepartments = $pdo->prepare($sql);
        $getDepartments->execute([$facultyId]);
        $departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);

        if ($departments) {
            echo json_encode($departments, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Такого кафедры не существует", JSON_THROW_ON_ERROR);
        }
    }
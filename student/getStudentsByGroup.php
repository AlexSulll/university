<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once dirname(__DIR__) . "/thesaurus/dataBase.php";

    if (isset($_GET["groupId"])) {
        $groupId = $_GET["groupId"];
        $sql = file_get_contents(dirname(__DIR__) . "/sql/students/getStudents.sql");

        $getStudents = $pdo->prepare($sql);
        $getStudents->execute([$groupId]);
        $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

        if ($students) {
            echo json_encode($students, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Такой группы не существует", JSON_THROW_ON_ERROR);
        }
    }
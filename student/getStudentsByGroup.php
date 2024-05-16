<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["groupId"])) {
        $groupId = $_GET["groupId"];
        $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudents.sql");

        $getStudents = $pdo->prepare($sql);
        $getStudents->execute([$groupId]);
        $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

        if ($students) {
            echo json_encode($students, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Такой группы не существует", JSON_UNESCAPED_UNICODE);
        }
    }
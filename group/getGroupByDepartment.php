<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["departmentId"])) {
        $departmentId = $_GET["departmentId"];
        $sql = file_get_contents(__DIR__ . "/../sql/group/getGroup.sql");

        $getGroups = $pdo->prepare($sql);
        $getGroups->execute([$departmentId]);
        $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

        if ($groups) {
            echo json_encode($groups, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Такой группы не существует", JSON_THROW_ON_ERROR);
        }
    }
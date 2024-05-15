<?php

    header("Content-Type: application/json");

    global $pdo;
    include __DIR__."/../thesaurus/dataBase.php";

    $groupId = $_GET["groupId"];
    $sql = file_get_contents(__DIR__."/../sql/group/sqlGetGroupId.sql");

    $getGroup = $pdo->prepare($sql);
    $getGroup->execute([$groupId]);
    $groups = $getGroup->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($groups, JSON_UNESCAPED_UNICODE);

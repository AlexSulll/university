<?php

    header("Content-Type: application/json");

    global $pdo;
    include "../thesaurus/dataBase.php";

    $idGroup = $_GET["groupId"];
    $sql = file_get_contents("../sql/group/sqlGetGroupId.sql");

    $getGroup = $pdo->prepare($sql);
    $getGroup->execute([$idGroup]);
    $group = $getGroup->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($group, JSON_UNESCAPED_UNICODE);

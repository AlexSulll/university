<?php

    header('Content-Type: application/json');

    global $pdo;
    include 'dataBase.php';

    $idGroup = $_GET["group_id"];
    $sql = file_get_contents("sqlRequests/sqlGetGroupId.txt");

    $getGroup = $pdo->prepare($sql);
    $getGroup->execute([$idGroup]);
    $group = $getGroup->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($group, JSON_UNESCAPED_UNICODE);

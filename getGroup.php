<?php

    global $pdo;
    include 'dataBase.php';

    $sql = file_get_contents("sqlRequests/sqlGroup.txt").$_GET["department_id"];

    $getGroups = $pdo->query($sql);
    $groups = $getGroups->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($groups, JSON_UNESCAPED_UNICODE);

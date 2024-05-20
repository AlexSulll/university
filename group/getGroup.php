<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/../thesaurus/dataBase.php";

    if (isset($_GET["groupId"])) {
        $group = getGroup($_GET["groupId"]);
        if ($group) {
            echo $group;
        } else {
            echo json_encode("Такой группы не существует", JSON_THROW_ON_ERROR);
        }
    }

    function getGroup(int $groupId): ?string
    {
        global $pdo;
        $sql = file_get_contents(__DIR__ . "/../sql/group/getGroupId.sql");

        $getGroup = $pdo->prepare($sql);
        $getGroup->execute([$groupId]);
        $groups = $getGroup->fetchAll(PDO::FETCH_ASSOC);

        if ($groups) {
            return json_encode($groups, JSON_UNESCAPED_UNICODE);
        } else {
            return null;
        }
    }

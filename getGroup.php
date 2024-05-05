<?php

    include 'sqlConnect.php';

    $sql = "SELECT * FROM oasu.group WHERE `id_of_department`=".$_GET['department_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    $json = [];
    foreach ($result as $row) {
        $json[] = ['group_id' => $row['group_id'], 'name_of_group' => $row['name_of_group']];
    }

    echo json_encode($json, JSON_UNESCAPED_UNICODE);

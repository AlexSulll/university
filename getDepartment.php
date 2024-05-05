<?php

    include 'sqlConnect.php';

    $sql = "SELECT * FROM oasu.department WHERE `id_of_faculties`=".$_GET['faculty_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    $json = [];
    foreach ($result as $row) {
        $json[] = ['department_id' => $row['department_id'], 'name_of_department' => $row['name_of_department']];
    }

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
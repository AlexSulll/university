<?php

    include 'sqlConnect.php';

    $sql = "SELECT * FROM oasu.faculties";
    $result = mysqli_query($GLOBALS['link'], $sql);
    $json = [];
    foreach ($result as $row) {
        $json[] = ['faculty_id' => $row['faculty_id'], 'name_faculty' => $row['name_faculty']];
    }
    echo json_encode($json,JSON_UNESCAPED_UNICODE);


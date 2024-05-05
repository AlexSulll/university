<?php

    include 'sqlConnect.php';

    $sql = "SELECT * FROM oasu.students WHERE `id_of_group`=".$_GET['group_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    $json = [];
    foreach ($result as $row) {
        $json[] = ['student_id' => $row['student_id'], 'name_of_student' => $row['name_of_student']];
    }

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
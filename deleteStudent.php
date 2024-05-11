<?php

    include 'dataBase.php';

    if (isset($_GET['student_id'])) {
        deleteStudent($_GET['student_id']);
    }

    function deleteStudent($idStudent)
    {
        global $pdo;
        $sql = file_get_contents('sqlRequests/sqlDeleteStudent.txt');
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idStudent]);
    }

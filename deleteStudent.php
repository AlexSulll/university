<?php

    include 'dataBase.php';

    if (isset($_GET['studentId'])) {
        deleteStudent($_GET['studentId']);
    }

    function deleteStudent($idStudent)
    {
        global $pdo;
        $sql = file_get_contents('sqlRequests/sqlDeleteStudent.txt');
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idStudent]);
    }

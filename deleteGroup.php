<?php

    include 'deleteStudent.php';

    if (isset($_GET['groupId'])) {
        deleteGroup($_GET['groupId']);
    }

    function deleteGroup($idGroup)
    {
        global $pdo;
        $sql = file_get_contents('sqlRequests/sqlGetStudents.txt');
        $getStudents = $pdo->prepare($sql);
        $getStudents->execute([$idGroup]);
        $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $student) {
            deleteStudent($student['student_id']);
        }

        $sql = file_get_contents('sqlRequests/sqlDeleteGroup.txt');
        $delGroup = $pdo->prepare($sql);
        $delGroup->execute([$idGroup]);
    }
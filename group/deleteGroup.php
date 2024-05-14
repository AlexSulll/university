<?php

    include "../student/deleteStudent.php";

    if (isset($_GET["groupId"])) {
        deleteGroup($_GET["groupId"]);
    }

    function deleteGroup(int $idGroup): void
    {
        global $pdo;
        $sql = file_get_contents("../sql/students/sqlGetStudents.sql");
        $getStudents = $pdo->prepare($sql);
        $getStudents->execute([$idGroup]);
        $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $student) {
            deleteStudent($student["student_id"]);
        }

        $sql = file_get_contents("../sql/group/sqlDeleteGroup.sql");
        $delGroup = $pdo->prepare($sql);
        $delGroup->execute([$idGroup]);
    }
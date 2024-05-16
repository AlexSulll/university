<?php

    global $pdo;
    require_once __DIR__."/../student/deleteStudent.php";

    if (isset($_GET["groupId"])) {
        $groupId = $_GET["groupId"];
        $sql = file_get_contents(__DIR__."/../sql/group/sqlGetGroupId.sql");
        $getGroup = $pdo->prepare($sql);
        $getGroup->execute([$groupId]);
        if ($getGroup->fetch()) {
            deleteGroup($groupId);
        } else {
            echo json_encode("Такой группы не существует",JSON_UNESCAPED_UNICODE);
        }
    }

    function deleteGroup(int $groupId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__."/../sql/students/sqlGetStudents.sql");
        $getStudents = $pdo->prepare($sql);
        $getStudents->execute([$groupId]);
        $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $student) {
            deleteStudent($student["student_id"]);
        }

        $sql = file_get_contents(__DIR__."/../sql/group/sqlDeleteGroup.sql");
        $deleteGroup = $pdo->prepare($sql);
        $deleteGroup->execute([$groupId]);
    }
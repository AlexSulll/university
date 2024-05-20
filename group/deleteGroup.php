<?php

    global $pdo;
    require_once __DIR__."/../student/deleteStudent.php";

    if (isset($_POST["groupId"])) {
        $groupId = $_POST["groupId"];
        $sql = file_get_contents(__DIR__ . "/../sql/group/getGroupId.sql");
        $getGroup = $pdo->prepare($sql);
        $getGroup->execute([$groupId]);
        if ($getGroup->fetch()) {
            deleteGroup($groupId);
        } else {
            echo json_encode("Такой группы не существует",JSON_THROW_ON_ERROR);
        }
    }

    function deleteGroup(int $groupId): void
    {
        global $pdo;
        $sql = file_get_contents(__DIR__ . "/../sql/students/getStudents.sql");
        $getStudents = $pdo->prepare($sql);
        $getStudents->execute([$groupId]);
        $students = $getStudents->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $student) {
            deleteStudent($student["student_id"]);
        }

        $sql = file_get_contents(__DIR__ . "/../sql/group/deleteGroup.sql");
        $deleteGroup = $pdo->prepare($sql);
        $deleteGroup->execute([$groupId]);
    }
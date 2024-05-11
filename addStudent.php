<?php

    global $pdo;
    include 'dataBase.php';

    $studentId = null;
    $nameStudent = $_POST['name'];
    $groupStudent = $_POST['group'];

    $sql = file_get_contents('sqlRequests/sqlAddStudent.txt');
    $addStudent = $pdo->prepare($sql);

    try {
        $addStudent->execute([
            'studentId' => $studentId,
            'nameStudent' => $nameStudent,
            'groupStudent' => $groupStudent
        ]);
    } catch (PDOException $exception) {
        echo "Ошибка при добавлении нового студента: {$exception->getMessage()}";
    }
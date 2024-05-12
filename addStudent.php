<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['nameStudent']) && isset($_POST['groupId'])) {
        $studentId = null;
        $nameStudent = $_POST['nameStudent'];
        $groupId = $_POST['groupId'];

        $sql = file_get_contents('sqlRequests/sqlAddStudent.txt');
        $addStudent = $pdo->prepare($sql);

        try {
            $addStudent->execute([
                'studentId' => $studentId,
                'nameStudent' => $nameStudent,
                'groupStudent' => $groupId
            ]);
        } catch (PDOException $exception) {
            echo "Ошибка при добавлении нового студента: {$exception->getMessage()}";
        }
    } else {
        echo "Заполните все поля";
    }

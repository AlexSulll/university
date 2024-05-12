<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['nameGroup']) && isset($_POST['departmentId'])) {
        $groupId = null;
        $nameGroup = $_POST['nameGroup'];
        $departmentId = $_POST['departmentId'];

        $sql = file_get_contents('sqlRequests/sqlAddGroup.txt');
        $addStudent = $pdo->prepare($sql);

        try {
            $addStudent->execute([
                'groupId' => $groupId,
                'nameGroup' => $nameGroup,
                'departmentGroup' => $departmentId
            ]);
        } catch (PDOException $exception) {
            echo "Ошибка при добавлении нового студента: {$exception->getMessage()}";
        }
    } else {
        echo "Заполните все поля";
    }

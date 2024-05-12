<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['nameFaculty'])) {
        $facultyId = null;
        $nameFaculty = $_POST['nameFaculty'];

        $sql = file_get_contents('sqlRequests/sqlAddFaculty.txt');
        $addStudent = $pdo->prepare($sql);

        try {
            $addStudent->execute([
                'facultyId' => $facultyId,
                'nameFaculty' => $nameFaculty
            ]);
        } catch (PDOException $exception) {
            echo "Ошибка при добавлении нового студента: {$exception->getMessage()}";
        }
    } else {
        echo "Заполните все поля";
    }

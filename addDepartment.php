<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['nameDepartment']) && isset($_POST['facultyId'])) {
        $departmentId = null;
        $nameDepartment = $_POST['nameDepartment'];
        $facultyId = $_POST['facultyId'];

        $sql = file_get_contents('sqlRequests/sqlAddDepartment.txt');
        $addStudent = $pdo->prepare($sql);

        try {
            $addStudent->execute([
                'departmentId' => $departmentId,
                'nameDepartment' => $nameDepartment,
                'facultyId' => $facultyId
            ]);
        } catch (PDOException $exception) {
            echo "Ошибка при добавлении нового факультета: {$exception->getMessage()}";
        }
    } else {
        echo "Заполните все поля";
    }
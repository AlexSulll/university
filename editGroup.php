<?php

    global $pdo;
    include 'dataBase.php';

    if (isset($_POST['groupId'])) {
        $groupId = $_POST['groupId'];
        $newNameGroup = $_POST['newNameGroup'];
        $newDepartmentId = $_POST['newDepartmentId'];

        $sql = file_get_contents('sqlRequests/sqlEditGroup.txt');
        $editStudent = $pdo->prepare($sql);
        $editStudent->execute([
            'newNameGroup' => $newNameGroup,
            'newDepartmentId' => $newDepartmentId,
            'groupId' => $groupId
        ]);
    }

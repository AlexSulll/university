<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/thesaurus/dataBase.php";

    $sqlDataBase = file_get_contents(__DIR__ . "/sql/getTree.sql");
    $resultDataBase = $pdo->query($sqlDataBase);
    $dataBase = $resultDataBase->fetchAll(PDO::FETCH_ASSOC);

    $keys = ["faculty_id", "department_id", "group_id", "student_id"];
    $names = ["name_faculty", "name_of_department", "name_of_group", "name_of_student"];
    $subarray = ["departments", "groups", "students"];

    $tree = array();

    foreach ($dataBase as $item) {
        addToTree($tree, $item, $keys, $names, $subarray);
    }

    function addToTree(array &$tree,array $item,array $keys,array $names,array $subarray): void
    {
        $facultyId = $item[$keys[0]];
        $departmentId = $item[$keys[1]];
        $groupId = $item[$keys[2]];
        $studentId = $item[$keys[3]];

        if (!isset($tree[$facultyId])) {
            $tree[$facultyId] = array(
                $keys[0] => $facultyId,
                $names[0] => $item[$names[0]],
                $subarray[0] => array()
            );
        }

        if (!isset($tree[$facultyId][$subarray[0]][$departmentId])) {
            $tree[$facultyId][$subarray[0]][$departmentId] = array(
                $keys[1] => $departmentId,
                $names[1] => $item[$names[1]],
                $subarray[1] => array()
            );
        }

        if (!isset($tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId])) {
            $tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId] = array(
                $keys[2] => $groupId,
                $names[2] => $item[$names[2]],
                $subarray[2] => array()
            );
        }

        if (!isset($tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId][$subarray[2]][$studentId])) {
            $tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId][$subarray[2]][$studentId] = array(
                $keys[3] => $studentId,
                $names[3] => $item[$names[3]]
            );
        }
    }

    echo json_encode($tree, JSON_UNESCAPED_UNICODE);
<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once dirname(__DIR__) . "/html/thesaurus/dataBase.php";

    $sqlDataBase = file_get_contents(dirname(__DIR__) . "/html/sql/getTree.sql");
    $resultDataBase = $pdo->query($sqlDataBase);
    $dataBase = $resultDataBase->fetchAll(PDO::FETCH_ASSOC);

    $keys = ["faculty_id", "department_id", "group_id", "student_id"];
    $names = ["name_faculty", "name_of_department", "name_of_group", "name_of_student"];
    $subarray = ["departments", "groups", "students"];

    $tree = array();

    foreach ($dataBase as $item) {
        addToTree($tree, $item, $keys, $names, $subarray);
    }

    function addToTree(array &$tree,array $item,array $keys,array $names,array $subarray): void {
        $facultyId = $item[$keys[0]];
        $departmentId = $item[$keys[1]];
        $groupId = $item[$keys[2]];
        $studentId = $item[$keys[3]];

        if (!isset($tree[$facultyId])) {
            $tree[$facultyId] = newBranch($item, $keys, $names, $subarray, 0, $facultyId);
        }

        if (!isset($tree[$facultyId][$subarray[0]][$departmentId])) {
            $tree[$facultyId][$subarray[0]][$departmentId] = newBranch($item, $keys, $names, $subarray, 1, $departmentId);
        }

        if (!isset($tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId])) {
            $tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId] = newBranch($item, $keys, $names, $subarray, 2, $groupId);
        }

        if (!isset($tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId][$subarray[2]][$studentId])) {
            $tree[$facultyId][$subarray[0]][$departmentId][$subarray[1]][$groupId][$subarray[2]][$studentId] = newBranch($item, $keys, $names, $subarray, 3, $studentId);
        }
    }

    function newBranch(array $item,array $keys,array $names,array $subarray,int $index,int $elementId): array {
        if ($index === 3) {
            return array(
                $keys[$index] => $elementId,
                $names[$index] => $item[$names[$index]]
            );
        }

        return array(
          $keys[$index] => $elementId,
          $names[$index] => $item[$names[$index]],
          $subarray[$index] => array()
        );
    }

    echo json_encode($tree, JSON_UNESCAPED_UNICODE);
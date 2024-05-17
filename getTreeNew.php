<?php

    header("Content-Type: application/json");

    global $pdo;
    require_once __DIR__."/thesaurus/dataBase.php";

    $tree = array();

    $sqlFaculties = file_get_contents(__DIR__."/sql/faculty/sqlGetFaculty.sql");
    $resultFaculties = $pdo->query($sqlFaculties);
    $faculties = $resultFaculties->fetchAll(PDO::FETCH_ASSOC);

    $sqlDepartments = file_get_contents(__DIR__."/sql/department/sqlGetDepartmentAll.sql");
    $resultDepartments = $pdo->query($sqlDepartments);
    $departments = $resultDepartments->fetchAll(PDO::FETCH_ASSOC);

    $sqlGroups = file_get_contents(__DIR__."/sql/group/sqlGetGroupAll.sql");
    $resultGroups = $pdo->query($sqlGroups);
    $groups = $resultGroups->fetchAll(PDO::FETCH_ASSOC);

    $sqlStudents = file_get_contents(__DIR__."/sql/students/sqlGetStudentsAll.sql");
    $resultStudents = $pdo->query($sqlStudents);
    $students = $resultStudents->fetchAll(PDO::FETCH_ASSOC);

#Буду фиксить
    foreach ($faculties as $faculty) {
        $faculty = array(
            "faculty_id" => $faculty["faculty_id"],
            "name_faculty" => $faculty["name_faculty"],
            "department" => [getChildren($departments, $faculty["faculty_id"]),
                "group" => getChildren($groups, $faculty["faculty_id"]["department"]),
                    "students" => getChildren($students, $faculty["faculty_id"]["department"]["group_id"])]);
        $tree[] = $faculty;
    }
    function getChildren(array $data, int $id): array
    {
        $newData = array();
        foreach ($data as $element=>$item) {
            if ($item[array_key_last($item)] == $id) {
                $newData[$item[array_key_first($item)]] = $item;
            }
        }
        return $newData;
    }

echo json_encode($tree, JSON_UNESCAPED_UNICODE);
<?php

    header('Content-Type: application/json');

    global $pdo;
//    include "dataBase.php";

    $sqlFaculties = file_get_contents('sql/sqlGetFaculty.sql');
    $resultFaculties = $pdo->query($sqlFaculties);
    $faculties = $resultFaculties->fetchAll(PDO::FETCH_ASSOC);

    foreach ($faculties as $faculty) {
        $sqlDepartment = file_get_contents("sql/sqlGetDepartment.sql");
        $resultDepartment = $pdo->prepare($sqlDepartment);
        $resultDepartment->execute([$faculty['faculty_id']]);
        $department = $resultDepartment->fetchAll(PDO::FETCH_ASSOC);
        foreach ($department as $newDepartment) {
            $faculties[$faculty['faculty_id'] - 1]['department'][$newDepartment['department_id']] = $newDepartment;
        }
        foreach ($faculties[$faculty['faculty_id'] - 1]['department'] as &$departmentNew) {
            $sqlGroup = file_get_contents("sql/sqlGetGroup.sql");
            $resultGroup = $pdo->prepare($sqlGroup);
            $resultGroup->execute([$departmentNew['department_id']]);
            $groups = $resultGroup->fetchAll(PDO::FETCH_ASSOC);
            foreach ($groups as $newGroups) {
                $departmentNew['groups'][$newGroups['group_id']] = $newGroups;
            }
            foreach ($departmentNew['groups'] as &$groupNew) {
                $sqlStudents = file_get_contents('sql/sqlGetStudents.sql');
                $resultStudent = $pdo->prepare($sqlStudents);
                $resultStudent->execute([$groupNew['group_id']]);
                $students = $resultStudent->fetchAll(PDO::FETCH_ASSOC);
                foreach ($students as $student) {
                    $groupNew['students'][$student['student_id']] = $student;
                }
                unset($groupNew);
            }
            unset($departmentNew);
        }
    }

    echo json_encode($faculties, JSON_UNESCAPED_UNICODE);
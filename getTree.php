<?php

    global $pdo;
    include "dataBase.php";

    $sqlFaculties = file_get_contents('sqlRequests/sqlGetFaculty.txt');
    $resultFaculties = $pdo->query($sqlFaculties);
    $faculties = $resultFaculties->fetchAll(PDO::FETCH_ASSOC);

    foreach ($faculties as $faculty) {
        $sqlDepartment = file_get_contents("sqlRequests/sqlGetDepartment.txt").$faculty['faculty_id'];
        $resultDepartment = $pdo->query($sqlDepartment);
        $department = $resultDepartment->fetchAll(PDO::FETCH_ASSOC);
        foreach ($department as $newDepartment) {
            $faculties[$faculty['faculty_id'] - 1]['department'][$newDepartment['department_id']] = $newDepartment;
        }
        foreach ($faculties[$faculty['faculty_id'] - 1]['department'] as &$departmentNew) {
            $sqlGroup = file_get_contents("sqlRequests/sqlGetGroup.txt").$departmentNew['department_id'];
            $resultGroup = $pdo->query($sqlGroup);
            $groups = $resultGroup->fetchAll(PDO::FETCH_ASSOC);
            foreach ($groups as $newGroups) {
                $departmentNew['groups'][$newGroups['group_id']] = $newGroups;
            }
            foreach ($departmentNew['groups'] as &$groupNew) {
                $sqlStudents = file_get_contents('sqlRequests/sqlGetStudent.txt').$groupNew['group_id'];
                $resultStudent = $pdo->query($sqlStudents);
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
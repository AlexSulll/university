<?php

    include "sqlConnect.php";

    $sqlFaculties = "SELECT * FROM oasu.faculties";
    $resultFaculties = mysqli_query($GLOBALS['link'], $sqlFaculties);
    $faculties = [];
    while ($row = mysqli_fetch_assoc($resultFaculties)) {
        $faculties[$row['faculty_id']] = $row;
    }

    foreach ($faculties as $faculty) {
        $sqlDepartment = "SELECT * FROM oasu.department WHERE `id_of_faculties`=".$faculty['faculty_id'];
        $resultDepartment = mysqli_query($GLOBALS['link'], $sqlDepartment);
        while ($row = mysqli_fetch_assoc($resultDepartment)) {
            $faculties[$faculty['faculty_id']]['department'][$row['department_id']] = $row;
        }
        foreach ($faculties[$faculty['faculty_id']]['department'] as &$departmentNew) {
            $sqlGroup = "SELECT * FROM oasu.group WHERE `id_of_department`=".$departmentNew['department_id'];
            $resultGroup = mysqli_query($GLOBALS['link'], $sqlGroup);
            while ($row = mysqli_fetch_assoc($resultGroup)) {
                $departmentNew['groups'][$row['group_id']] = $row;
            }
            foreach ($departmentNew['groups'] as &$groupNew) {
                $sqlStudents = "SELECT * FROM oasu.students WHERE `id_of_group`=".$groupNew['group_id'];
                $resultStudent = mysqli_query($GLOBALS['link'], $sqlStudents);
                while ($row = mysqli_fetch_assoc($resultStudent)) {
                    $groupNew['students'][$row['student_id']] = $row;
                }
            }
        }
    }

    echo json_encode($faculties, JSON_UNESCAPED_UNICODE);
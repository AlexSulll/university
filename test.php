<?php

include 'sqlConnect.php';

$id_faculty = 1;
$sql = 'SELECT `department_id`, `name_of_department` FROM oasu.department WHERE id_of_faculties = $id_faculty' ;
$result = mysqli_query($GLOBALS['link'], $sql);
var_dump($result);
?>
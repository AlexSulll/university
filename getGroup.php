<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Группы</title>
</head>
<body>
<h2>
    <?php
    include 'sqlConnect.php';
    $sql = "SELECT `name_of_department` FROM oasu.department WHERE `department_id`=".$_GET['department_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    $row = mysqli_fetch_array($result);
    $name = stristr($row['name_of_department'], ' ');
    echo "Группы кафедры" . $name;
    ?>
</h2>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Название группы</td>
        <td>Студенты</td>
        <td>Редактировать группу</td>
        <td>Удалить группу</td>
    </tr>
    <?php
    $sql = "SELECT `group_id`, `name_of_group` FROM oasu.group WHERE `id_of_department`=".$_GET['department_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    foreach ($result as $row) {
        echo '<tr>';
            echo "<td> {$row['group_id']} </td>";
            echo "<td> {$row['name_of_group']} </td>";
            echo "<td><a href='getStudents.php?group_id={$row['group_id']}'>Открыть</a></td>";
            echo "<td><a href=''>Редактировать</a></td>";
            echo "<td><a href=''>Удалить</a></td>";
        echo '</tr>';
    }
    ?>
</table>
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Кафедры</title>
</head>
<body>
<h2>
    <?php
    include 'sqlConnect.php';
    $sql = "SELECT `name_faculty` FROM oasu.faculties WHERE `faculty_id`=".$_GET['faculty_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    $row = mysqli_fetch_array($result);
    $name = stristr($row['name_faculty'], ' ');
    echo "Кафедры факультета" . $name;
    ?>
</h2>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Название кафедры</td>
        <td>Группы</td>
        <td>Редактировать кафедру</td>
        <td>Удалить кафедру</td>
    </tr>
    <?php
    $sql = "SELECT `department_id`, `name_of_department` FROM oasu.department WHERE `id_of_faculties`=".$_GET['faculty_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    foreach ($result as $row) {
        echo '<tr>';
            echo "<td> {$row['department_id']} </td>";
            echo "<td> {$row['name_of_department']} </td>";
            echo "<td><a href='getGroup.php?department_id={$row['department_id']}'>Открыть</a></td>";
            echo "<td><a href=''>Редактировать</a></td>";
            echo "<td><a href=''>Удалить</a></td>";
        echo '</tr>';
    }
    ?>
</table>
<button onclick=history.back()>Вернуться назад</button>
</body>
</html>
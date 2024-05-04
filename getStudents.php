<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Студенты группы</title>
</head>
<body>
<h2>
    <?php
    include 'sqlConnect.php';
    $sql = "SELECT `name_of_group` FROM oasu.group WHERE `group_id`=".$_GET['group_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    $row = mysqli_fetch_array($result);
    echo "Студенты группы " . $row['name_of_group'];
    ?>

</h2>
<table>
    <tr>
        <td>ID</td>
        <td>ФИО студента</td>
        <td>Редактировать ФИО</td>
        <td>Удалить студента</td>
    </tr>
    <?php
    $sql = "SELECT `student_id`, `name_of_student` FROM oasu.students WHERE `id_of_group`=".$_GET['group_id'];
    $result = mysqli_query($GLOBALS['link'], $sql);
    foreach ($result as $row) {
        echo '<tr>';
            echo "<td>" . $row['student_id'] . "</td>";
            echo "<td>" . $row['name_of_student'] . "</td>";
            echo "<td><a href=''>Редактировать</a></td>";
            echo "<td><form action='deleteStudent.php' method='post'>
                    <input type='hidden' name='student_id' value='" . $row["student_id"] . "'/>
                    <input type='submit' value='Удалить'/>
            </form></td>";
        echo '</tr>';
    }


    ?>
</table>
<button onclick=history.back()>Вернуться назад</button>
<a href="?action=addStudent">Добавить студента</a>
</body>

</html>
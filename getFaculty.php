<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Факультеты</title>
</head>
<body>
<h2>РГУ нефти и газа (НИУ) им. И.М.Губкина</h2>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Название факультета</td>
        <td>Кафедры</td>
        <td>Редактировать</td>
        <td>Удалить факультет</td>
    </tr>
    <?php

    include 'sqlConnect.php';

    $sql = 'SELECT `faculty_id`, `name_faculty` FROM oasu.faculties';
    $result = mysqli_query($GLOBALS['link'], $sql);
    foreach ($result as $row) {
        echo '<tr>';
            echo "<td> {$row['faculty_id']} </td>";
            echo "<td> {$row['name_faculty']} </td>";
            echo "<td><a href='getDepartment.php?faculty_id={$row['faculty_id']}'>Открыть</a></td>";
            echo "<td><a href=''>Редактировать</a></td>";
            echo "<td><a href=''>Удалить</a></td>";
        echo '</tr>';
    }
    ?>
</table>
<button onclick=addFaculty()>Добавить факультет</button>
</body>
</html>

<!--//$host = '127.0.0.1';-->
<!--//$dbname = 'oasu';-->
<!--//$username = 'root';-->
<!--//$password = 'passbd';-->
<!--//$port = 3306;-->
<!--//-->
<!--////$pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$username,$password);-->
<!--//-->
<!--//$link = mysqli_connect($host, $username, $password);-->
<!--//-->
<!--//$sql = "SELECT faculty_id,name_faculty FROM oasu.faculties";-->
<!--//-->
<!--//$result = mysqli_query($link, $sql);-->
<!--//-->
<!--//while ($row = mysqli_fetch_array($result)) {-->
<!--//    echo "Id факультета: " . $row['faculty_id'] . ";-->
<!--//    Название: " . $row['name_faculty'] . "<br>";-->
<!--//}-->
<!---->
<!---->
<!--//$stmt = $pdo->query($sql);-->
<!--//-->
<!--//$facul = $stmt->fetchAll(PDO::FETCH_ASSOC);-->
<!--//var_dump($facul);-->
<!---->
<!--//while ($user = $stmt->fetch(PDO::FETCH_ASSOC)){-->
<!--//    var_dump($user);-->
<!--//}-->
<!--//foreach ($faculties as $faculty) {-->
<!--//-->
<!--//}-->
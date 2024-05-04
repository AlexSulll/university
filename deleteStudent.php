<?php
include 'sqlConnect.php';
if (isset($_POST['student_id'])) {
    $user_id = mysqli_real_escape_string($GLOBALS['link'], $_POST['student_id']);
    $sql = "DELETE FROM oasu.students WHERE student_id=".$user_id;
    mysqli_query($GLOBALS['link'], $sql);
    mysqli_close($GLOBALS['link']);
    echo "<html lang='ru'><head><meta http-equiv='refresh' content='0;URL=".$_SERVER['HTTP_REFERER']."'></head></html>";
}
?>

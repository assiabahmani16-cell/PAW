<?php
require 'db_connect.php';

$sql = $conn->prepare("
    INSERT INTO attendance_sessions (course_id, group_id, date, opened_by, status)
    VALUES (?, ?, NOW(), ?, 'open')
");

$sql->execute([$_POST['course_id'], $_POST['group_id'], $_POST['professor_id']]);

echo "Session created!";
?>

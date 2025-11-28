<?php
require 'db_connect.php';

$sql = $conn->prepare("UPDATE attendance_sessions SET status='closed' WHERE id=?");
$sql->execute([$_POST['session_id']]);

echo "Session closed!";
?>

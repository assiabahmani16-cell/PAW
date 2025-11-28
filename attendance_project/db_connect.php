<?php
require_once "config.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful";
} catch (PDOException $e) {
    file_put_contents("db_errors.log", $e->getMessage(), FILE_APPEND);
    echo "Connection failed";
}

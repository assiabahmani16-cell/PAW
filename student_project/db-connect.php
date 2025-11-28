<?php
require_once "config.php";

function connectDB() {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME;

    try {
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // success ? return connection object

    } catch (PDOException $e) {
        // optional: save the error in a file
        file_put_contents("db_errors.log", $e->getMessage() . "\n", FILE_APPEND);
        return false; // connection failed
    }
}
?>
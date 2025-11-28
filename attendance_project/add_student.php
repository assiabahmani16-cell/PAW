<?php

$student_id = $_POST['student_id'];
$name = $_POST['name'];
$group = $_POST['group'];

if (empty($student_id) || empty($name) || empty($group)) {
    die("All fields are required");
}


$students = [];
if (file_exists("students.json")) {
    $students = json_decode(file_get_contents("students.json"), true);
}


$students[] = [
    "student_id" => $student_id,
    "name" => $name,
    "group" => $group
];

file_put_contents("students.json", json_encode($students, JSON_PRETTY_PRINT));


echo "Student added successfully!";

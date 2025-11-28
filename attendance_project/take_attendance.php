<?php
$date = date("Y-m-d");
$filename = "attendance_$date.json";


if (file_exists($filename)) {
    die("Attendance for today has already been taken.");
}


$students = json_decode(file_get_contents("students.json"), true);


$attendance = [];
foreach ($students as $s) {
    $status = $_POST["status_" . $s["student_id"]];
    $attendance[] = [
        "student_id" => $s["student_id"],
        "status" => $status
    ];
}


file_put_contents($filename, json_encode($attendance, JSON_PRETTY_PRINT));

echo "Attendance saved successfully!";

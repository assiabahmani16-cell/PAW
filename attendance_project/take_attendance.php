<?php
$date = date("Y-m-d");
$filename = "attendance_$date.json";

// إذا الملف موجود → يعني حضور اليوم تم تسجيله
if (file_exists($filename)) {
    die("Attendance for today has already been taken.");
}

// تحميل قائمة الطلبة
$students = json_decode(file_get_contents("students.json"), true);

// إدخال الحضور
$attendance = [];
foreach ($students as $s) {
    $status = $_POST["status_" . $s["student_id"]];
    $attendance[] = [
        "student_id" => $s["student_id"],
        "status" => $status
    ];
}

// حفظ الملف
file_put_contents($filename, json_encode($attendance, JSON_PRETTY_PRINT));

echo "Attendance saved successfully!";

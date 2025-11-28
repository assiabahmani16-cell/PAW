<?php
// 1. قراءة القيم القادمة من الفورم
$student_id = $_POST['student_id'];
$name = $_POST['name'];
$group = $_POST['group'];

// 2. التحقق من صحة البيانات
if (empty($student_id) || empty($name) || empty($group)) {
    die("All fields are required");
}

// 3. قراءة الملف إن وُجد
$students = [];
if (file_exists("students.json")) {
    $students = json_decode(file_get_contents("students.json"), true);
}

// 4. إضافة الطالب
$students[] = [
    "student_id" => $student_id,
    "name" => $name,
    "group" => $group
];

// 5. حفظ الملف
file_put_contents("students.json", json_encode($students, JSON_PRETTY_PRINT));

// 6. رسالة نجاح
echo "Student added successfully!";

<?php


echo '<pre>';
print_r($_POST);
echo '</pre>';

// Database configuration
$host = 'localhost';
$dbname = 'database';
$username = 'root';        // Change to your MySQL username
$password = '';            // Change to your MySQL password

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "No data received!";
}

// Get POST data
$student_id = trim($_POST['student_id'] ?? '');
$last_name  = trim($_POST['last_name'] ?? '');
$first_name = trim($_POST['first_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$group_id   = trim($_POST['group_id'] ?? '');

// Validate input
if (empty($student_id) || empty($last_name) || empty($first_name) || empty($group_id)) {
    die("All fields are required");
}

$name = $first_name . " " . $last_name;

// Prepare and execute the INSERT query (using prepared statements to prevent SQL injection)
$sql = "INSERT INTO $ (student_id, name, email, group_id) VALUES (:student_id, :name, :email, :group_id)";


try {
    $stmt = $pdo->prepare($sql);
   $stmt->execute([
    ':student_id' => $student_id,
    ':name'       => $name,
    ':email'      => $email,
    ':group_id'   => $group_id
]);


    echo "Student added successfully!";
} catch (PDOException $e) {
    // If student_id already exists (duplicate entry), or any other error
    if ($e->getCode() == 23000) {  // Duplicate entry error code
        echo "Error: Duplicate Student ID or Email.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>

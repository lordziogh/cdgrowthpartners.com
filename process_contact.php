<?php
include 'db_connect.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : null;
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
    $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : null;
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : null;

    if ($name && $email && $phone && $message) {
        $sql = "INSERT INTO contact_requests (name, email, phone, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Contact request submitted successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "❌ Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('❌ Missing form data! Please fill in all required fields.'); window.location.href='index.html';</script>";
    }
}

$conn->close();
?>


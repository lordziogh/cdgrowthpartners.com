<?php
include 'db_connect.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $partnership_type = isset($_POST["partnership_type"]) ? $_POST["partnership_type"] : null;
    $message = isset($_POST["message"]) ? $_POST["message"] : null;

    if ($name && $email && $phone && $partnership_type && $message) {
        $sql = "INSERT INTO partner_requests (name, email, phone, partnership_type, message) VALUES ('$name', '$email', '$phone', '$partnership_type', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('✅ Partnership request submitted successfully!'); window.location.href='partner.html';</script>";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('❌ Missing form data! Please fill in all required fields.'); window.location.href='partner.html';</script>";
    }
    
    $conn->close();
}
?>

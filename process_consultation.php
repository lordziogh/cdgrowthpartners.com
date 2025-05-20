<?php
include 'db_connect.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $preferred_date = isset($_POST["preferred_date"]) ? $_POST["preferred_date"] : null;
    $message = isset($_POST["message"]) ? $_POST["message"] : null;

    if ($name && $email && $phone && $preferred_date && $message) {
        $sql = "INSERT INTO consultation_requests (name, email, phone, preferred_date, message) VALUES ('$name', '$email', '$phone', '$preferred_date', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('✅ Consultation request submitted successfully!'); window.location.href='consultation.html';</script>";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('❌ Missing form data! Please fill in all required fields.'); window.location.href='consultation.html';</script>";
    }

    $conn->close();
}
?>

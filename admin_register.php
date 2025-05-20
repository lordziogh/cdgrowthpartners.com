<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $sql = "INSERT INTO admin_users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Admin user created successfully!'); window.location.href='admin_login.html';</script>";
    } else {
        echo "<script>alert('❌ Error: Unable to create user');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

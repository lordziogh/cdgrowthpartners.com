<?php
session_start();
include 'db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST["admin_id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : null;

    if ($password) {
        $sql = "UPDATE admin_users SET username=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $password, $admin_id);
    } else {
        $sql = "UPDATE admin_users SET username=?, email=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $admin_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('✅ Profile updated successfully!'); window.location.href='edit_profile.php';</script>";
    } else {
        echo "❌ Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

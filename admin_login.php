<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin_users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_username"] = $row["username"];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<script>alert('❌ Incorrect password!'); window.location.href='admin_login.php';</script>";
        }
    } else {
        echo "<script>alert('❌ Username not found!'); window.location.href='admin_login.html';</script>";
    }
    $stmt->close();
}
$conn->close();
?>


<?php
session_start();
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

$admin_username = $_SESSION["admin_username"];
$sql = "SELECT * FROM admin_users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>alert('❌ Error: User not found!'); window.location.href='admin_login.php';</script>";
    exit();
}
?>

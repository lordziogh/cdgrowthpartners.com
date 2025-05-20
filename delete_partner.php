<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM partner_requests WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('✅ Partnership request deleted successfully!');
    window.location.href='admin_dashboard.php';
  </script>";
} else {
echo "<script>
    alert('❌ Error deleting request: " . $conn->error . "');
    window.location.href='admin_dashboard.php';
  </script>";
}
?>

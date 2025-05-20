<?php
session_start();
include 'db_connect.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $table = isset($_POST["table"]) ? $_POST["table"] : null;

    if ($id && $table) {
        $sql = "DELETE FROM $table WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "✅ Request deleted successfully!";
        } else {
            echo "❌ Error deleting request: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "❌ Invalid request!";
    }
}

$conn->close();
?>

<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM consultation_requests WHERE id='$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $preferred_date = $_POST["preferred_date"];
    $message = $_POST["message"];

    $sql = "UPDATE consultation_requests SET name='$name', email='$email', phone='$phone', preferred_date='$preferred_date', message='$message' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Consultation request updated successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "❌ Error updating request: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Consultation Request | CD Growth Partners</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        /* Form Styling */
form {
    max-width: 600px;
    margin: auto;
}

/* Input Fields */
.form-control {
    border: 2px solid #ffd904;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease-in-out;
}

/* Button Styling */
.btn-success {
    background: linear-gradient(to right, #008000, #FFA500, #FFD700);
    border: none;
    transition: all 0.3s ease-in-out;
}

.btn-success:hover {
    transform: scale(1.05);
    background: linear-gradient(to right, #006400, #FF8C00, #FFD700);
}

    </style>
</head>
<body>

    
            <h2 class="text-center text-success">Update Consultation Request</h2>
            <form action="" method="POST" class="p-4 shadow-lg rounded bg-light">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" name="phone" value="<?= $row['phone'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="preferred_date" class="form-label">Preferred Date</label>
                    <input type="date" name="preferred_date" value="<?= $row['preferred_date'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" class="form-control" required><?= $row['message'] ?></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Update Request</button>
            </form>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

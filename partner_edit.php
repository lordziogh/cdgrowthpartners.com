<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM partner_requests WHERE id='$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $partnership_type = $_POST["partnership_type"];
    $message = $_POST["message"];

    $sql = "UPDATE partner_requests SET name='$name', email='$email', phone='$phone', partnership_type='$partnership_type', message='$message' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Partnership request updated successfully!'); window.location.href='admin_dashboard.php';</script>";
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
    <title>Update Partner Request | CD Growth Partners</title>
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

            <h2 class="text-center text-success">Update Partnership Request</h2>
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
                    <label for="partnership_type" class="form-label">Partnership Type</label>
                    <select name="partnership_type" class="form-select">
                        <option value="Joint Ventures & Collaborations" <?= $row['partnership_type'] === 'Joint Ventures & Collaborations' ? 'selected' : '' ?>>Joint Ventures & Collaborations</option>
                        <option value="Investment & Funding Partnerships" <?= $row['partnership_type'] === 'Investment & Funding Partnerships' ? 'selected' : '' ?>>Investment & Funding Partnerships</option>
                        <option value="Strategic Alliances & Brand Collaborations" <?= $row['partnership_type'] === 'Strategic Alliances & Brand Collaborations' ? 'selected' : '' ?>>Strategic Alliances & Brand Collaborations</option>
                        <option value="Technology & Service Integrations" <?= $row['partnership_type'] === 'Technology & Service Integrations' ? 'selected' : '' ?>>Technology & Service Integrations</option>
                    </select>
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

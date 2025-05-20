<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Frofile</title>
    <style>
             /* Center the Login Container */
.container {
    max-width: 400px;
}

/* Card Styling */
.card {
    border-radius: 12px;
    background: #f8f9fa;
}

/* Button Styling */
.btn-success {
    background: linear-gradient(to right, #008000, #FFA500, #FFD700) !important;
    border: none;
    transition: all 0.3s ease-in-out;
}

.btn-success:hover {
    transform: scale(1.05);
    background: linear-gradient(to right, #006400, #FF8C00, #FFD700);
}
.back-button {
    position: absolute;
    top: 10px;
    right: 10px;
}
    </style>
</head>
<body>

<form action="update_profile.php" method="POST" class="container mt-4 p-4 rounded shadow-lg bg-light">
<input type="hidden" name="admin_id" value="<?= isset($user['id']) ? $user['id'] : '' ?>">

    <h2 class="text-center text-success mb-4">Edit Profile</h2>

    <div class="mb-3">
        <label class="form-label">Username:</label>
        <input type="text" class="form-control" name="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" placeholder="Enter new password">
    </div>

    <button type="submit" class="btn btn-success w-100">Update Profile</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


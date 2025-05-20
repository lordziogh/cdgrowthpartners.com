<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch requests
$contact_requests = $conn->query("SELECT * FROM contact_requests");
$partner_requests = $conn->query("SELECT * FROM partner_requests");
$consultation_requests = $conn->query("SELECT * FROM consultation_requests");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | CD Growth Partners</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .custom-icon {
    font-size: 50px;
    border: 3px solid white;
    border-radius: 50%;
    padding: 12px;
}
.navbar-text i {
    color: white;
    font-size: 22px;
}
.dropdown-toggle {
    border: none;
    background: transparent;
    font-size: 18px;
    color: white;
}

.dropdown-menu {
    min-width: 180px;
    text-align: center;
}
.navbar-text {
    display: flex;
    align-items: center;
}

.navbar-text span {
    margin-right: 5px; /* Adjust the spacing */
}







    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <?php if (isset($_SESSION["admin_username"])) { ?>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle fa-lg me-2"></i> <?= $_SESSION["admin_username"] ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="admin_profile.php">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="delete_user.php">Delete User</a></li>
                    <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
            <span class="navbar-text text-white">Welcome Back, <?= $_SESSION["admin_username"] ?>!</span>
        <?php } ?>
        <a class="btn btn-warning" href="index.html">Back to Website</a>
    </div>
</nav>

            <!-- Logout Warning -->
<div id="logoutWarning" class="toast align-items-center text-bg-warning border-0 position-fixed bottom-0 end-0 p-3" role="alert" aria-live="polite" aria-atomic="true" style="display: none;">
    <div class="d-flex">
        <div class="toast-body">
            ⚠ You are about to be logged out due to inactivity! Click anywhere to stay active.
            <div class="progress mt-2" style="height: 5px;">
                <div id="logoutProgress" class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
</div>
    </nav>



    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center text-primary">📋 Manage Requests</h2>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" data-bs-toggle="tab" href="#contact">Contact Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="partner-tab" data-bs-toggle="tab" href="#partner">Partnership Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="consultation-tab" data-bs-toggle="tab" href="#consultation">Consultation Requests</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Contact Requests -->
            <div class="tab-pane fade show active" id="contact">
                <div class="card shadow-lg p-4">
                    <h3 class="text-primary">Contact Requests</h3>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $contact_requests->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['message'] ?></td>
                                    <td>
                                    <a class="btn btn-primary" href="admin_edit.php?id=<?= $row['id'] ?>">Edit</a> |
                                        <!-- Delete Button -->
                               <button class="btn btn-danger delete-btn" data-id="<?= $row['id'] ?>" data-table="contact_requests">Delete</button>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Partner Requests -->
            <div class="tab-pane fade" id="partner">
                <div class="card shadow-lg p-4">
                    <h3 class="text-primary">Partnership Requests</h3>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th><th>Email</th><th>Phone</th><th>Partnership Type</th><th>Message</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $partner_requests->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['partnership_type'] ?></td>
                                    <td><?= $row['message'] ?></td>
                                    <td>
                                    <a class="btn btn-primary" href="partner_edit.php?id=<?= $row['id'] ?>">Edit</a> |
                                <!-- Delete Button -->
                               <button class="btn btn-danger delete-btn" data-id="<?= $row['id'] ?>" data-table="partner_requests">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Consultation Requests -->
            <div class="tab-pane fade" id="consultation">
                <div class="card shadow-lg p-4">
                    <h3 class="text-primary">Consultation Requests</h3>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th><th>Email</th><th>Phone</th><th>Preferred Date</th><th>Message</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $consultation_requests->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['preferred_date'] ?></td>
                                    <td><?= $row['message'] ?></td>
                                    <td>
                                    <a class="btn btn-primary" href="consult_edit.php?id=<?= $row['id'] ?>">Edit</a> |
                                                                            <!-- Delete Button -->
                               <button class="btn btn-danger delete-btn" data-id="<?= $row['id'] ?>" data-table="consultation_requests">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    let deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            let requestId = this.getAttribute("data-id");
            let table = this.getAttribute("data-table");

            if (confirm("⚠ Are you sure you want to delete this request?")) {
                fetch("delete_request.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${requestId}&table=${table}`
                }).then(response => response.text())
                  .then(data => {
                      alert(data);  
                      location.reload();  
                  }).catch(error => console.error("❌ Error:", error));
            }
        });
    });
});
function logout() {
    if (confirm("⚠ Are you sure you want to log out?")) {
        window.location.href = "logout.php";
    }
}

let inactivityTimer;
let warningTimer;
let progressInterval;
let tabInactive = false;

function resetTimer() {
    clearTimeout(inactivityTimer);
    clearTimeout(warningTimer);
    clearInterval(progressInterval);

    // Show warning 30 seconds before auto-logout
    warningTimer = setTimeout(() => {
        if (tabInactive) return; // Prevent warning if tab is inactive
        let toast = new bootstrap.Toast(document.getElementById("logoutWarning"));
        document.getElementById("logoutWarning").style.display = "block";
        toast.show();

        let progress = 100;
        progressInterval = setInterval(() => {
            progress -= 3.33;
            document.getElementById("logoutProgress").style.width = progress + "%";
            document.getElementById("logoutProgress").setAttribute("aria-valuenow", progress);
            if (progress <= 0) {
                clearInterval(progressInterval);
            }
        }, 1000);
    }, 270000); // 4.5 minutes (before 5-minute logout)

    inactivityTimer = setTimeout(() => {
        logout();
    }, 300000); // 5 minutes
}

// Detect when tab is inactive
document.addEventListener("visibilitychange", function () {
    if (document.hidden) {
        tabInactive = true;
        setTimeout(() => {
            if (tabInactive) logout(); // Log out if tab remains inactive for 1 minute
        }, 30000);
    } else {
        tabInactive = false;
        resetTimer(); // Reset the inactivity timer
    }
});

// Detect user interactions to reset timer
document.addEventListener("mousemove", resetTimer);
document.addEventListener("keypress", resetTimer);
document.addEventListener("click", resetTimer);

function logout() {
    window.location.href = "logout.php";
}

resetTimer();



    </script>
</body>
</html>

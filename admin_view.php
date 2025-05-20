<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch requests from the database
$contact_requests = $conn->query("SELECT * FROM contact_requests");
$partner_requests = $conn->query("SELECT * FROM partner_requests");
$consultation_requests = $conn->query("SELECT * FROM consultation_requests");

?>

<h2>Admin Dashboard</h2>

<h3>Contact Requests</h3>
<table border="1">
    <tr>
        <th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Action</th>
    </tr>
    <?php while ($row = $contact_requests->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['message'] ?></td>
            <td>
                <a href="admin_edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="delete_contact.php?id=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

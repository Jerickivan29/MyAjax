<?php
session_start(); // Always at the top
include 'db.php';

$action = $_POST['action'] ?? '';

if ($action == "login") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM t_Account WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user['username'];
        echo "success";
    } else {
        echo "invalid";
    }
}

if ($action == "check_login") {
    echo isset($_SESSION['user']) ? "logged_in" : "not_logged_in";
}

// ---- Your existing CRUD code (create/read/update/delete) below ----
// Just make sure it's inside: if(isset($_SESSION['user'])) { ... }

if (!isset($_SESSION['user'])) {
    exit("unauthorized");
}

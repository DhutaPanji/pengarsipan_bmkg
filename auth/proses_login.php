<?php
session_start();
include "../config.php"; // sesuaikan path ke config.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            header("Location: ../index.php?page=dashboard");
            exit;
        } else {
            header("Location: login.php?error=Password salah!");
            exit;
        }
    } else {
        header("Location: login.php?error=Username tidak ditemukan!");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}

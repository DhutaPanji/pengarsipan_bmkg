<?php
session_start();
include '../config.php'; // koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // ambil data user berdasarkan username
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();

        // verifikasi password
        if (password_verify($password, $data['password'])) {
            $_SESSION['user_id']  = $data['id'];
            $_SESSION['username'] = $data['username'];

           header("Location: ../sidebar/layout.php?page=dashboard");
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
        header("Location: login.php");
        exit();
    }
}

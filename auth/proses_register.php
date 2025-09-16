<?php
// koneksi ke database
$host = "localhost";
$user = "root"; // default XAMPP
$pass = "";     // default XAMPP (kosong)
$db   = "db_aplikasi"; // ganti dengan nama database kamu

$conn = new mysqli($host, $user, $pass, $db);

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ambil data dari form
$username   = $_POST['username'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$confirm    = $_POST['confirm_password'];

// validasi password sama
if ($password !== $confirm) {
    header("Location: register.php?status=error&msg=Password tidak sama!");
    exit;
}

// enkripsi password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// simpan ke database
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    header("Location: register.php?status=success&msg=Registrasi berhasil, silakan login.");
} else {
    header("Location: register.php?status=error&msg=Gagal registrasi: " . $conn->error);
}

$stmt->close();
$conn->close();

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Arsip BMKG</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">
    <h2 class="text-2xl font-bold text-center mb-6 flex items-center justify-center gap-2">
        <i class='bx bx-lock-alt text-blue-600'></i> Login
    </h2>

    <!-- Notifikasi Error -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Notifikasi Success -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="bg-blue-100 text-blue-700 p-3 rounded mb-4">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <!-- Form Login -->
    <form method="POST" action="proses_login.php" class="space-y-4">
        <div>
            <label class="block mb-1">Username</label>
            <input type="text" name="username" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
        </div>
        <div>
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 flex items-center justify-center gap-2">
            <i class='bx bx-log-in'></i> Login
        </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
        Belum punya akun? <a href="register.php" class="text-blue-600 hover:underline">Register</a>
    </p>
</div>
</body>
</html>

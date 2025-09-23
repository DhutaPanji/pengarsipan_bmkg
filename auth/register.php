<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Arsip BMKG</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">
    <h2 class="text-2xl font-bold text-center mb-6 flex items-center justify-center gap-2">
        <i class='bx bx-user-plus text-blue-600'></i> Register
    </h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="proses_register.php" class="space-y-4">
        <div>
            <label class="block mb-1">Username</label>
            <input type="text" name="username" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
        </div>
        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
        </div>
        <div>
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 flex items-center justify-center gap-2">
            <i class='bx bx-save'></i> Daftar
        </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
        Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>
</body>
</html>

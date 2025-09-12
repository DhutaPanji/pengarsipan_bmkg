<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body class="bg-indigo-600 min-h-screen flex items-center justify-center">
  <div class="bg-white w-full max-w-md p-8 rounded-md shadow-md">
    
    <div class="flex flex-col items-center mb-6">
      <i class="fas fa-user fa-2x text-indigo-600 mb-2"></i>
      <h1 class="text-2xl font-bold">Login</h1>
    </div>

    <form action="#" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block mb-1 font-medium">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter Username..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="password" class="block mb-1 font-medium">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center">
          <input type="checkbox" class="mr-1">
          Remember Me
        </label>
        <a href="#" class="text-indigo-600 hover:underline">Forgot Password?</a>
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors">
        Login
      </button>
    </form>

    <!-- Tambahan: Link ke register -->
    <p class="text-center text-sm text-gray-600 mt-4">
      Belum punya akun?
      <a href="register.php" class="text-indigo-600 hover:underline">Daftar</a>
    </p>
  </div>
</body>
</html>

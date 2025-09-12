<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body class="bg-indigo-600 min-h-screen flex items-center justify-center">
  <div class="bg-white w-full max-w-md p-8 rounded-md shadow-md">

    <div class="flex flex-col items-center mb-6">
      <i class="fas fa-user-plus fa-2x text-indigo-600 mb-2"></i>
      <h1 class="text-2xl font-bold">Register</h1>
    </div>

    <form action="#" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block mb-1 font-medium">Username</label>
        <input type="text" id="username" name="username" placeholder="Create Username..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="email" class="block mb-1 font-medium">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Email..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="password" class="block mb-1 font-medium">Password</label>
        <input type="password" id="password" name="password" placeholder="Create Password..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <div>
        <label for="confirm_password" class="block mb-1 font-medium">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors">
        Register
      </button>
    </form>

    <!-- Link ke login -->
    <p class="text-center text-sm text-gray-600 mt-4">
      Sudah punya akun?
      <a href="login.php" class="text-indigo-600 hover:underline">Login</a>
    </p>
  </div>
</body>
</html>

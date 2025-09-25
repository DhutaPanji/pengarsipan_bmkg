<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Navbar dengan Dropdown & Panah</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- NAVBAR -->
  <nav class="bg-white shadow px-6 py-3 flex items-center justify-between fixed top-0 left-64 right-0 z-50">
    <!-- Logo -->
    <div class="flex items-center space-x-3">
      <span class="text-lg font-semibold text-gray-700">👑🦧 bleking</span>
    </div>

    <!-- Profil + Dropdown -->
    <div class="relative">
      <!-- Tombol Profil -->
      <button id="dropdownButton" class="flex items-center space-x-2 focus:outline-none">
        <img src="https://i.pravatar.cc/40" alt="Profil" class="w-10 h-10 rounded-full border-2 border-gray-300">
        <span class="hidden md:inline text-gray-700 font-medium">panjir</span>
        <!-- Ikon panah kanan -->
        <svg id="arrowRight" class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <!-- Ikon panah bawah (hidden dulu) -->
        <svg id="arrowDown" class="w-4 h-4 text-gray-500 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <!-- Isi Dropdown -->
      <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
        <a href="profil.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
        <hr class="my-1">
        <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-red-100">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="pt-20 pl-64 px-6">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <p class="mt-2 text-gray-600"> </p>
  </div>

  <!-- Script Dropdown -->
  <script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const arrowRight = document.getElementById('arrowRight');
    const arrowDown = document.getElementById('arrowDown');

    dropdownButton.addEventListener('click', (e) => {
      e.stopPropagation();
      dropdownMenu.classList.toggle('hidden');
      arrowRight.classList.toggle('hidden');
      arrowDown.classList.toggle('hidden');
    });

    // Tutup dropdown jika klik di luar
    window.addEventListener('click', () => {
      dropdownMenu.classList.add('hidden');
      arrowDown.classList.add('hidden');
      arrowRight.classList.remove('hidden');
    });
  </script>

</body>
</html>

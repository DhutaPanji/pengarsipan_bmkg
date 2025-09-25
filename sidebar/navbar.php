<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php"); // redirect kalau belum login
  exit;
}
$username = $_SESSION['username'];
?>

<!-- Boxicons untuk icon -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<nav class="bg-white shadow px-6 py-3 flex items-center justify-between fixed top-0 left-64 right-0 z-50 h-20">
  <div class="flex-1"></div>

  <!-- Profil + Dropdown -->
  <div class="relative">
    <button id="dropdownButton" class="flex items-center space-x-2 focus:outline-none">
      <!-- Default Avatar -->
      <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" 
           alt="Profil" 
           class="w-10 h-10 rounded-full border-2 border-gray-300">
      <!-- Username dari session -->
      <span class="hidden md:inline text-gray-700 font-medium">
        <?= htmlspecialchars($username) ?>
      </span>
      <!-- Panah kanan -->
      <svg id="arrowRight" class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
      </svg>
      <!-- Panah bawah -->
      <svg id="arrowDown" class="w-4 h-4 text-gray-500 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <!-- Dropdown Menu -->
    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
      <a href="../auth/logout.php" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-100">
        <i class='bx bx-log-out text-lg mr-2'></i> Logout
      </a>
    </div>
  </div>
</nav>

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

  // Klik di luar menu → tutup dropdown
  window.addEventListener('click', (e) => {
    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.add('hidden');
      arrowDown.classList.add('hidden');
      arrowRight.classList.remove('hidden');
    }
  });
</script>

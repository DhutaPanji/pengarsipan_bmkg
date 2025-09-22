<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Arsip Surat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleMenu() {
      const submenu = document.getElementById("submenu");
      const arrow = document.getElementById("arrow");
      submenu.classList.toggle("hidden");
      arrow.classList.toggle("rotate-90");
    }
  </script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen">
  <!-- SIDEBAR -->
  <aside class="w-64 bg-white shadow-md flex flex-col border-r">
    <div class="p-6 text-xs tracking-widest text-gray-400 font-bold">MENU</div>

    <nav class="px-4 space-y-1">
      <!-- Dashboard -->
      <a href="?page=dashboard"
         class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $page === 'dashboard' ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'hover:bg-gray-50' ?>">
        <span>🏠</span> <span>Dashboard</span>
      </a>

      <!-- Dropdown Menu -->
      <div>
        <button onclick="toggleMenu()"
                class="flex items-center justify-between w-full px-3 py-2 rounded-lg hover:bg-gray-50">
          <div class="flex items-center gap-3">
            <span>📑</span> <span>Menu</span>
          </div>
          <span id="arrow" class="text-sm transition-transform 
            <?= ($page === 'arsip' || $page === 'tambah') ? 'rotate-90' : '' ?>">➤</span>
        </button>

        <!-- Submenu -->
        <div id="submenu" class="ml-8 mt-1 space-y-1 <?= ($page === 'arsip' || $page === 'tambah') ? '' : 'hidden' ?>">
          <a href="?page=arsip"
             class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm <?= $page === 'arsip' ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-indigo-500' ?>">
            <span>📁</span> <span>Arsip</span>
          </a>
          <a href="?page=tambah"
             class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm <?= $page === 'tambah' ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-indigo-500' ?>">
            <span>🗳️</span> <span>Upload Data</span>
          </a>
        </div>
      </div>
    </nav>
  </aside>

  <!-- CONTENT -->
  <main class="flex-1 p-6">
    <?php
      if ($page === 'dashboard') {
        include __DIR__ . '/../dashboard.php';
      } elseif ($page === 'arsip') {
        include __DIR__ . '/../arsip.php';
      } elseif ($page === 'tambah') {
        include __DIR__ . '/../upload.php';
      } else {
        echo "<h1 class='text-2xl font-bold'>404</h1><p class='text-gray-500'>Halaman tidak ditemukan.</p>";
      }
    ?>
  </main>
</div>

</body>
</html>

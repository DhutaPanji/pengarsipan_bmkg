<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Arsip Surat</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen">
  <!-- SIDEBAR -->
  <aside class="w-64 bg-white shadow-md flex flex-col border-r">
    <div class="p-6 text-xs tracking-widest text-black-400 font-bold">MENU</div>

    <nav class="px-4 space-y-1">
      <a href="?page=dashboard"
         class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $page === 'dashboard' ? 'bg-gray-100' : 'hover:bg-gray-50' ?>">
        <span>🏠</span> <span>Dashboard</span>
      </a>

      <a href="?page=arsip"
         class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $page === 'arsip' ? 'bg-gray-100' : 'hover:bg-gray-50' ?>">
        <span>📁</span> <span>Arsip</span>
      </a>

      <a href="?page=tambah"
         class="flex items-center gap-3 px-3 py-2 rounded-lg <?= $page === 'upload.php' ? 'bg-gray-100' : 'hover:bg-gray-50' ?>">
        <span>🏳️‍🌈</span> <span>Upload Data</span>
      </a>
    </nav>

  </aside>

  <!-- CONTENT -->
  <main class="flex-1 p-6">
    <?php
      if ($page === 'dashboard') {
        include __DIR__ . '/../dashboard.php';
      } elseif ($page === 'arsip') {
        include __DIR__ . '/../arsip.php';
      } elseif ($page === 'upload') {
        include __DIR__ . '/../upload.php';
      } else {
        echo "<h1 class='text-2xl font-bold'>404</h1><p class='text-gray-500'>Halaman tidak ditemukan.</p>";
      }
    ?>
  </main>
</div>

</body>
</html>

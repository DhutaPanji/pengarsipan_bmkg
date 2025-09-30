<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil flash jika ada
$flash = null;
if (!empty($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Upload Surat</title>
  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <!-- Container Utama -->
  <main class="flex-1 flex items-start justify-center p-6">
    <div class="bg-white p-10 rounded-xl shadow-md w-full max-w-2xl">
      <h2 class="text-2xl font-semibold text-center mb-6">Unggah File Surat</h2>

      <!-- Form Upload -->
      <form action="../proses_upload.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <label class="block text-sm font-medium text-gray-700">
          PILIH FILE SURAT (PDF)
        </label>

        <input type="file" name="fileSurat[]" accept=".pdf" multiple required
          class="block w-full text-sm text-gray-500
                 file:mr-4 file:py-2 file:px-4
                 file:rounded-l-md file:border-0
                 file:text-sm file:font-semibold
                 file:bg-gray-100 file:text-gray-700
                 hover:file:bg-gray-200">

        <p class="text-xs text-gray-500 mt-1">
          👉 Anda dapat memilih lebih dari satu file dengan menekan <b>CTRL</b> (Windows) atau <b>Command</b> (Mac) saat memilih file.
        </p>

        <p class="text-xs text-gray-500">
          Nama file: <span class="font-mono">YYYYMMDD_NomorSurat_KodeSurat_PerihalSurat.pdf</span>
        </p>

        <button type="submit" 
          class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 rounded-lg shadow-md transition">
          Upload Surat
        </button>

        <p class="text-xs text-red-500 mt-2">
          Contoh nama file: <span class="font-mono">20190805_ME.104-224-KMP-VII-2019_ME_Perihal Surat.pdf</span>
        </p>
      </form>
    </div>
  </main>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if ($flash): ?>
  <script>
  Swal.fire({
    icon: '<?= $flash['type'] === 'success' ? 'success' : ($flash['type'] === 'warning' ? 'warning' : 'error') ?>',
    title: '<?= ucfirst($flash['type']) ?>',
    text: '<?= $flash['msg'] ?>',
    confirmButtonText: 'OK'
  });
  </script>
  <?php endif; ?>

</body>
</html>

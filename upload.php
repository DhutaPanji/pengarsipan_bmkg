<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/config.php";

// Variabel flash untuk pesan
$flash = null;

// Jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['fileSurat']) && $_FILES['fileSurat']['error'] === 0) {
        $fileTmp  = $_FILES['fileSurat']['tmp_name'];
        $fileName = $_FILES['fileSurat']['name'];

        // Validasi hanya PDF
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if ($ext !== 'pdf') {
            $_SESSION['flash'] = ['msg' => 'Hanya file PDF yang diizinkan!', 'type' => 'error'];
            header("Location: ?page=tambah");
            exit;
        }

        // Buat folder uploads jika belum ada
        $targetDir = __DIR__ . "/uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        // Pindahkan file
        $targetFile = $targetDir . basename($fileName);
        move_uploaded_file($fileTmp, $targetFile);

        // Ambil data dari nama file
        $namaTanpaExt = pathinfo($fileName, PATHINFO_FILENAME);
        $parts = explode("_", $namaTanpaExt, 4);

        if (count($parts) >= 4) {
            $tanggal = date("Y-m-d", strtotime($parts[0]));
            $nomor   = $parts[1];
            $kode    = $parts[2];
            $perihal = $parts[3];

            // Simpan ke database
            $sql = "INSERT INTO surat (tanggal, nomor_surat, perihal, file_pdf) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $tanggal, $nomor, $perihal, $fileName);
            mysqli_stmt_execute($stmt);
        }

        // Flash message sukses
        $_SESSION['flash'] = ['msg' => 'Berhasil Mengunggah Surat', 'type' => 'success'];

        // Redirect ke halaman yang sama agar flash bisa ditampilkan
        header("Location: ?page=tambah");
        exit;
    }
}

// Ambil flash jika ada
if (!empty($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}
?>

<!-- HTML Tampilan Form -->
<main class="flex-1 flex items-start justify-center p-6 mt-10">
  <div class="bg-white p-10 rounded-xl shadow-md w-full max-w-2xl">
    <h2 class="text-2xl font-semibold text-center mb-6">Unggah File Surat</h2>

    <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
      <label class="block text-sm font-medium text-gray-700">
        PILIH FILE SURAT (PDF)
      </label>

      <input type="file" name="fileSurat" accept=".pdf" required
        class="block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4
               file:rounded-l-md file:border-0
               file:text-sm file:font-semibold
               file:bg-gray-100 file:text-gray-700
               hover:file:bg-gray-200">

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
  icon: '<?= $flash['type'] === 'success' ? 'success' : 'error' ?>',
  title: '<?= $flash['type'] === 'success' ? 'Berhasil' : 'Gagal' ?>',
  text: '<?= $flash['msg'] ?>',
  confirmButtonText: 'OK'
});
</script>
<?php endif; ?>

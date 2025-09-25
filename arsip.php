<?php
// arsip.php
include "config.php";

// Hapus surat
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'hapus') {
  $id = intval($_GET['id']);
  $result = $conn->query("SELECT file_pdf FROM surat WHERE id=$id");
  $file = $result && $result->num_rows > 0 ? $result->fetch_assoc()['file_pdf'] : null;

  $delete = $conn->query("DELETE FROM surat WHERE id=$id");

  if ($delete && $file && file_exists("uploads/$file")) {
    unlink("uploads/$file");
  }

  $_SESSION['flash'] = [
    'status' => $delete ? 'success' : 'error',
    'message' => $delete ? 'Surat berhasil dihapus!' : 'Surat gagal dihapus!'
  ];

  header("Location: ?page=arsip");
  exit;
}

// Update surat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $id      = intval($_POST['id']);
  $tanggal = $_POST['tanggal'];
  $nomor   = $_POST['nomor_surat'];
  $perihal = $_POST['perihal'];

  $stmt = $conn->prepare("UPDATE surat SET tanggal=?, nomor_surat=?, perihal=? WHERE id=?");
  $stmt->bind_param("sssi", $tanggal, $nomor, $perihal, $id);
  $ok = $stmt->execute();

  $_SESSION['flash'] = [
    'status' => $ok ? 'success' : 'error',
    'message' => $ok ? 'Surat berhasil diperbarui!' : 'Gagal memperbarui surat!'
  ];

  header("Location: ?page=arsip");
  exit;
}

// Ambil semua data
$sql = "SELECT * FROM surat ORDER BY created_at DESC";
$result = $conn->query($sql);
$arsip = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $arsip[] = $row;
  }
}
?>

<!-- Tambahkan Boxicons -->
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<?php if (isset($_SESSION['flash'])): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      Swal.fire({
        icon: '<?= $_SESSION['flash']['status'] ?>',
        title: '<?= $_SESSION['flash']['status'] === 'success' ? 'Berhasil' : 'Gagal' ?>',
        text: '<?= $_SESSION['flash']['message'] ?>',
        showConfirmButton: false,
        timer: 1500
      });
    });
  </script>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="bg-white shadow-lg rounded-lg p-6">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold text-gray-700">📂 Daftar Surat</h2>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-600 border border-gray-300 rounded-lg border-collapse">
      <thead>
        <tr class="bg-gradient-to-r from-gray-400 to-gray-400 text-white text-xs uppercase">
          <th class="px-4 py-3 border border-gray-300">No</th>
          <th class="px-4 py-3 border border-gray-300">Tanggal Surat</th>
          <th class="px-4 py-3 border border-gray-300">Nomor Surat</th>
          <th class="px-4 py-3 border border-gray-300">Perihal Surat</th>
          <th class="px-4 py-3 text-center border border-gray-300">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($arsip)): ?>
          <?php foreach ($arsip as $i => $r): ?>
            <tr class="hover:bg-gray-50 transition">
              <td class="px-4 py-3 font-medium border border-gray-300"><?= $i+1 ?></td>
              <td class="px-4 py-3 border border-gray-300"><?= htmlspecialchars($r['tanggal']) ?></td>
              <td class="px-4 py-3 border border-gray-300"><?= htmlspecialchars($r['nomor_surat']) ?></td>
              <td class="px-4 py-3 border border-gray-300"><?= htmlspecialchars($r['perihal']) ?></td>
              <td class="px-4 py-3 border border-gray-300">
                <div class="flex items-center justify-center gap-2">
                  <!-- Tombol Lihat -->
                  <?php if (!empty($r['file_pdf'])): ?>
                    <a href="uploads/<?= htmlspecialchars($r['file_pdf']) ?>" target="_blank"
                       class="px-3 py-1 rounded-lg text-white bg-sky-500 hover:bg-sky-600 transition flex items-center gap-1">
                      <i class='bx bx-show text-lg'></i> Lihat
                    </a>
                  <?php else: ?>
                    <button type="button"
                            class="px-3 py-1 rounded-lg text-white bg-gray-400 cursor-not-allowed flex items-center gap-1" disabled>
                      <i class='bx bx-show text-lg'></i> Tidak Ada File
                    </button>
                  <?php endif; ?>

                  <!-- Tombol Edit -->
                  <button type="button"
                          class="btn-edit px-3 py-1 rounded-lg text-white bg-amber-400 hover:bg-amber-500 transition flex items-center gap-1"
                          data-id="<?= $r['id'] ?>"
                          data-tanggal="<?= htmlspecialchars($r['tanggal']) ?>"
                          data-nomor="<?= htmlspecialchars($r['nomor_surat']) ?>"
                          data-perihal="<?= htmlspecialchars($r['perihal']) ?>">
                    <i class='bx bx-pencil text-lg'></i> Edit
                  </button>

                  <!-- Tombol Hapus -->
                  <button type="button"
                          class="btn-hapus px-3 py-1 rounded-lg text-white bg-red-500 hover:bg-red-600 transition flex items-center gap-1"
                          data-id="<?= $r['id'] ?>">
                    <i class='bx bx-trash text-lg'></i> Hapus
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center p-5 text-gray-500 italic border border-gray-300">
              Belum ada data surat 📭
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Hapus
document.querySelectorAll('.btn-hapus').forEach(btn => {
  btn.addEventListener('click', function () {
    const id = this.dataset.id;
    Swal.fire({
      title: 'Hapus surat ini?',
      text: "Data yang dihapus tidak bisa dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ef4444',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `?page=arsip&action=hapus&id=${id}`;
      }
    });
  });
});

// Edit
document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', function () {
    const id      = this.dataset.id;
    const tanggal = this.dataset.tanggal;
    const nomor   = this.dataset.nomor;
    const perihal = this.dataset.perihal;

    Swal.fire({
      title: 'Edit Surat',
      html: `
        <form id="formEdit" method="POST">
          <input type="hidden" name="id" value="${id}">
          <table class="w-full text-sm text-left text-gray-600">
            <tr>
              <td class="py-2 pr-2">Tanggal Surat</td>
              <td><input type="date" name="tanggal" value="${tanggal}" class="swal2-input w-full" required></td>
            </tr>
            <tr>
              <td class="py-2 pr-2">Nomor Surat</td>
              <td><input type="text" name="nomor_surat" value="${nomor}" class="swal2-input w-full" required></td>
            </tr>
            <tr>
              <td class="py-2 pr-2">Perihal Surat</td>
              <td><input type="text" name="perihal" value="${perihal}" class="swal2-input w-full" required></td>
            </tr>
          </table>
          <input type="hidden" name="update" value="1">
        </form>
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: 'Update',
      cancelButtonText: 'Batal',
      preConfirm: () => {
        document.getElementById('formEdit').submit();
      }
    });
  });
});
</script>

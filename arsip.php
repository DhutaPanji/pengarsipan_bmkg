<?php
// arsip.php
include "config.php";

// Hapus surat jika ada action=hapus
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'hapus') {
  $id = intval($_GET['id']);
  $delete = $conn->query("DELETE FROM surat WHERE id=$id");

  $_SESSION['flash'] = [
    'status' => $delete ? 'success' : 'error',
    'message' => $delete ? 'Surat berhasil dihapus!' : 'Surat gagal dihapus!'
  ];

  header("Location: ?page=arsip");
  exit;
}

// Ambil semua data dari tabel surat
$sql = "SELECT * FROM surat ORDER BY created_at DESC";
$result = $conn->query($sql);
$arsip = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $arsip[] = $row;
  }
}
?>

<h1 class="text-2xl font-bold mb-6">Arsip Surat</h1>

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

<div class="bg-white shadow rounded-lg p-6">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-semibold">Daftar Surat</h2>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-100 text-gray-700 text-sm">
          <th class="p-3 text-left">NO</th>
          <th class="p-3 text-left">TANGGAL SURAT</th>
          <th class="p-3 text-left">NOMOR SURAT</th>
          <th class="p-3 text-left">PERIHAL SURAT</th>
          <th class="p-3 text-center">AKSI</th>
        </tr>
      </thead>
      <tbody class="text-sm">
        <?php if (!empty($arsip)): ?>
          <?php foreach ($arsip as $i => $r): ?>
            <tr class="border-t">
              <td class="p-3"><?= $i+1 ?></td>
              <td class="p-3"><?= htmlspecialchars($r['tanggal']) ?></td>
              <td class="p-3"><?= htmlspecialchars($r['nomor_surat']) ?></td>
              <td class="p-3"><?= htmlspecialchars($r['perihal']) ?></td>
              <td class="p-3">
                <div class="flex items-center justify-center gap-2">
                  <a href="?page=arsip&action=lihat&id=<?= $r['id'] ?>" 
                     class="px-3 py-1 rounded text-white bg-sky-500 hover:bg-sky-600">Lihat</a>
                  <a href="?page=arsip&action=edit&id=<?= $r['id'] ?>" 
                     class="px-3 py-1 rounded text-white bg-amber-400 hover:bg-amber-500">Edit</a>
                  <button type="button" 
                          class="btn-hapus px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600"
                          data-id="<?= $r['id'] ?>">
                    Hapus
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center p-4 text-gray-500">Belum ada data surat</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Tambahkan SweetAlert2 untuk tombol hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-hapus').forEach(btn => {
  btn.addEventListener('click', function () {
    const id = this.dataset.id;
    Swal.fire({
      title: 'Hapus surat ini?',
      text: "Data yang dihapus tidak bisa dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ef4444', // red-500
      cancelButtonColor: '#6b7280', // gray-500
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `?page=arsip&action=hapus&id=${id}`;
      }
    });
  });
});
</script>

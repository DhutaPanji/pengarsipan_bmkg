<h1 class="text-2xl font-bold mb-6">Arsip Surat</h1>

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
      </tbody>
    </table>
  </div>
</div>

<!-- Tambahkan SweetAlert2 dan JS -->
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

<?php
$flash = get_flash();

// Data contoh (array)
$arsip = [
  ["tanggal" => "05-08-2019", "nomor" => "ME.104-224-KMP-VII-2019", "perihal" => "Koreksi Sandi Pilot Balon"],
  ["tanggal" => "21-03-2019", "nomor" => "ME.305-089-III-TBK-2019", "perihal" => "Buletin Analisa Klimatologi Bulanan"],
  ["tanggal" => "21-01-2019", "nomor" => "ME.305-036-I-TBK-2019", "perihal" => "Buletin Analisa Klimatologi Bulanan"],
  ["tanggal" => "25-01-2016", "nomor" => "ME.401-003-HNM-I-2016", "perihal" => "Data Curah Hujan"],
];
?>

<h1 class="text-2xl font-bold mb-6">Arsip Surat</h1>

<?php if ($flash): ?>
  <div class="mb-4 px-4 py-3 rounded <?= 
       $flash['type'] === 'success' ? 'bg-green-50 text-green-700' :
       ($flash['type'] === 'danger' ? 'bg-red-50 text-red-700' : 'bg-blue-50 text-blue-700')
     ?>">
    <?= esc($flash['msg']); ?>
  </div>
<?php endif; ?>

<div class="bg-white shadow rounded-lg p-6">
  <h2 class="text-lg font-semibold mb-4">Daftar Surat</h2>
  <div class="overflow-x-auto">
    <table class="w-full border-collapse" id="table-arsip">
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
          <tr class="border-t" data-id="<?= $i ?>">
            <td class="p-3"><?= $i+1 ?></td>
            <td class="p-3 tanggal"><?= esc($r['tanggal']) ?></td>
            <td class="p-3 nomor"><?= esc($r['nomor']) ?></td>
            <td class="p-3 perihal"><?= esc($r['perihal']) ?></td>
            <td class="p-3">
              <div class="flex items-center justify-center gap-2">
                <a href="?page=arsip&action=lihat&id=<?= $i ?>" 
                   class="px-3 py-1 rounded text-white bg-sky-500 hover:bg-sky-600">Lihat</a>
                <button type="button"
                        class="btn-edit px-3 py-1 rounded text-white bg-amber-400 hover:bg-amber-500"
                        data-id="<?= $i ?>"
                        data-tanggal="<?= esc($r['tanggal']) ?>"
                        data-nomor="<?= esc($r['nomor']) ?>"
                        data-perihal="<?= esc($r['perihal']) ?>">
                  Edit
                </button>
                <button type="button" 
                        class="btn-hapus px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600"
                        data-id="<?= $i ?>">
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

<!-- MODAL EDIT -->
<div id="modal-edit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
    <h2 class="text-lg font-semibold mb-4">Edit Surat</h2>
    <form id="form-edit" class="space-y-4">
      <input type="hidden" id="edit-id">
      <div>
        <label class="block mb-1 text-sm font-medium">Tanggal Surat</label>
        <input type="date" id="edit-tanggal"
               class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring focus:ring-sky-200">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">Nomor Surat</label>
        <input type="text" id="edit-nomor"
               class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring focus:ring-sky-200">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">Perihal Surat</label>
        <input type="text" id="edit-perihal"
               class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring focus:ring-sky-200">
      </div>
      <div class="flex items-center gap-2">
        <button type="submit" 
                class="px-4 py-2 rounded-lg bg-sky-500 text-white hover:bg-sky-600">
          Simpan
        </button>
        <button type="button" id="btn-cancel"
                class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">
          Batal
        </button>
      </div>
    </form>
    <button id="btn-close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const modal = document.getElementById('modal-edit');
const editId = document.getElementById('edit-id');
const editTanggal = document.getElementById('edit-tanggal');
const editNomor = document.getElementById('edit-nomor');
const editPerihal = document.getElementById('edit-perihal');

document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', function () {
    editId.value = this.dataset.id;
    editTanggal.value = this.dataset.tanggal;
    editNomor.value = this.dataset.nomor;
    editPerihal.value = this.dataset.perihal;
    modal.classList.remove('hidden');
  });
});

document.getElementById('btn-cancel').addEventListener('click', () => modal.classList.add('hidden'));
document.getElementById('btn-close').addEventListener('click', () => modal.classList.add('hidden'));
window.addEventListener('click', (e) => {
  if (e.target === modal) modal.classList.add('hidden');
});

// UPDATE DATA DAN SHOW ALERT
document.getElementById('form-edit').addEventListener('submit', function(e){
  e.preventDefault();
  const id = editId.value;
  const tanggal = editTanggal.value;
  const nomor = editNomor.value;
  const perihal = editPerihal.value;

  // Update tabel langsung
  const row = document.querySelector(`tr[data-id="${id}"]`);
  row.querySelector('.tanggal').innerText = tanggal;
  row.querySelector('.nomor').innerText = nomor;
  row.querySelector('.perihal').innerText = perihal;

  modal.classList.add('hidden');

  // SweetAlert Notifikasi (Mirip Gambar Kamu)
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Berhasil menyimpan perubahan surat.',
    confirmButtonText: 'OK',
    confirmButtonColor: '#6366F1', // Ungu seperti contoh
    customClass: {
      popup: 'rounded-xl'
    }
  });
});

// HAPUS
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
        document.querySelector(`tr[data-id="${id}"]`).remove();
        Swal.fire('Terhapus!', 'Surat telah dihapus.', 'success');
      }
    });
  });
});
</script>

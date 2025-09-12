<?php $flash = get_flash(); ?>

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
            <td class="p-3"><?= esc($r['tanggal']) ?></td>
            <td class="p-3"><?= esc($r['nomor']) ?></td>
            <td class="p-3"><?= esc($r['perihal']) ?></td>
            <td class="p-3">
              <div class="flex items-center justify-center gap-2">
                <a href="?page=arsip&action=lihat&id=<?= $i ?>" class="px-3 py-1 rounded text-white bg-sky-500 hover:bg-sky-600">Lihat</a>
                <a href="?page=arsip&action=edit&id=<?= $i ?>" class="px-3 py-1 rounded text-white bg-amber-400 hover:bg-amber-500">Edit</a>
                <a href="?page=arsip&action=hapus&id=<?= $i ?>" class="px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600"
                   onclick="return confirm('Hapus surat ini?')">Hapus</a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

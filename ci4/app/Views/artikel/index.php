<?= $this->include('template/header'); ?>

<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">

    <div class="artikel-header">
        <h2>
            <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
                <?= $row['judul']; ?>
            </a>
        </h2>

        <span class="tanggal">
            <?= date('d M Y', strtotime($row['updated_at'])); ?>
        </span>
    </div>

    <div class="artikel-meta">
        <span class="kategori-badge">
            <?= $row['nama_kategori'] ?? 'Tanpa Kategori'; ?>
        </span>
    </div>

    <?php if(!empty($row['gambar'])) : ?>
    <img
        src="<?= base_url('gambar/'.$row['gambar']); ?>"
        alt="<?= $row['judul']; ?>">
    <?php endif; ?>
    
    <p><?= substr($row['isi'], 0, 200); ?></p>

</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>

<?= $this->include('template/footer'); ?>
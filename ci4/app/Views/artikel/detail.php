<?= $this->include('template/header'); ?>

<article class="detail-artikel">

    <div class="detail-header">

        <span class="kategori-badge">
            <?= $artikel['nama_kategori'] ?? 'Tanpa Kategori'; ?>
        </span>

        <h1><?= $artikel['judul']; ?></h1>

        <div class="detail-meta">
            <span>
                📅 <?= date('d F Y', strtotime($artikel['updated_at'])); ?>
            </span>
        </div>

    </div>

    <?php if(!empty($artikel['gambar'])) : ?>
        <div class="detail-image">
            <img
                src="<?= base_url('gambar/' . $artikel['gambar']); ?>"
                alt="<?= $artikel['judul']; ?>">
        </div>
    <?php endif; ?>

    <div class="detail-content">
        <?= nl2br($artikel['isi']); ?>
    </div>

    <div class="back-button">
        <a href="<?= base_url('/artikel'); ?>" class="btn-back">
            ← Kembali ke Daftar Artikel
        </a>
    </div>

</article>

<?= $this->include('template/footer'); ?>
<?= $this->include('template/admin_header'); ?>

<div class="stats-container">

    <div class="stat-card">
        <div class="stat-icon">📝</div>
        <div class="stat-title">Total Artikel</div>
        <div class="stat-number"><?= count($artikel) ?></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🌸</div>
        <div class="stat-title">Artikel Aktif</div>
        <div class="stat-number">15</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">💖</div>
        <div class="stat-title">Draft</div>
        <div class="stat-number">5</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✨</div>
        <div class="stat-title">Kategori</div>
        <div class="stat-number">3</div>
    </div>

</div>

<div class="admin-container">

    <div class="page-header">
        <div>
            <h2><?= $title ?? 'Daftar Artikel'; ?></h2>
            <p>Kelola seluruh artikel website.</p>
        </div>

        <a href="<?= base_url('admin/artikel/add'); ?>"
            class="btn btn-success">
            + Tambah Artikel
        </a>
    </div>

    <form method="get" class="form-search">

        <input
            type="text"
            name="q"
            value="<?= $q ?? '' ?>"
            placeholder="Cari judul artikel...">

        <button type="submit" class="btn btn-primary">
            🔍 Cari
        </button>

    </form>

    <table class="table">

        <thead>
            <tr>
                <th width="60">ID</th>
                <th width="100">Gambar</th>
                <th>Artikel</th>
                <th width="150">Kategori</th>
                <th width="120">Status</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>

            <?php if($artikel): ?>

                <?php foreach($artikel as $row): ?>

                <tr>

                    <td>
                        <?= $row['id']; ?>
                    </td>

                    <td>

                        <?php if(!empty($row['gambar'])) : ?>

                            <img
                                src="<?= base_url('gambar/'.$row['gambar']); ?>"
                                class="table-thumbnail"
                                alt="<?= $row['judul']; ?>">

                        <?php else : ?>

                            <div class="no-image">
                                No Image
                            </div>

                        <?php endif; ?>

                    </td>

                    <td>

                        <strong>
                            <?= $row['judul']; ?>
                        </strong>

                        <p class="article-preview">
                            <?= mb_substr(strip_tags($row['isi']), 0, 70); ?>
                        </p>

                    </td>

                    <td>

                        <span class="kategori-badge">

                            <?= $row['nama_kategori'] ?? 'Tanpa Kategori'; ?>

                        </span>

                    </td>

                    <td>

                        <?php if($row['status']) : ?>

                            <span class="status-active">
                                Aktif
                            </span>

                        <?php else : ?>

                            <span class="status-draft">
                                Draft
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <a
                            href="<?= base_url('admin/artikel/edit/'.$row['id']); ?>"
                            class="btn btn-primary">

                            Ubah

                        </a>

                        <a
                            href="<?= base_url('admin/artikel/delete/'.$row['id']); ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin menghapus artikel ini?');">

                            Hapus

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else : ?>

                <tr>

                    <td colspan="6" style="text-align:center">

                        Belum ada artikel.

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<div class="pagination">
    <?= $pager->only(['q'])->links(); ?>
</div>

<?= $this->include('template/admin_footer'); ?>
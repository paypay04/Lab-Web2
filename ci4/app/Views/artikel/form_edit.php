<?= $this->include('template/admin_header'); ?>

<div class="form-container">

    <div class="form-card">

        <div class="form-header">
            <h2>✏️ Edit Artikel</h2>
            <p>Perbarui informasi artikel.</p>
        </div>

        <form
            action="<?= base_url('admin/artikel/update/'.$artikel['id']); ?>"
            method="post"
            enctype="multipart/form-data">

            <div class="form-group">
                <label>Judul Artikel</label>
                <input
                    type="text"
                    name="judul"
                    class="form-control"
                    value="<?= $artikel['judul']; ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
            
                <select
                    name="id_kategori"
                    class="form-control"
                    required>
            
                    <option value="">Pilih Kategori</option>
            
                    <?php foreach($kategori as $k): ?>
                        <option
                            value="<?= $k['id_kategori']; ?>"
                            <?= $artikel['id_kategori'] == $k['id_kategori'] ? 'selected' : ''; ?>>
                    
                            <?= $k['nama_kategori']; ?>
                    
                        </option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="form-group">

                <label>Ganti Gambar Artikel</label>

                <input
                    type="file"
                    name="gambar"
                    class="form-control"
                    accept="image/*">

                <small class="form-text">
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

                <?php if(!empty($artikel['gambar'])) : ?>
                
                    <div class="preview-image">
                
                        <p>Gambar Saat Ini</p>
                
                        <img
                            src="<?= base_url('gambar/'.$artikel['gambar']); ?>"
                            alt="<?= $artikel['judul']; ?>">
                
                    </div>
                
                <?php endif; ?>
                
            </div>

            <div class="form-group">
                <label>Isi Artikel</label>

                <textarea
                    name="isi"
                    class="form-control"
                    rows="8"
                    required><?= $artikel['isi']; ?></textarea>
            </div>

            <div class="checkbox-group">
                <input
                    type="checkbox"
                    id="status"
                    name="status"
                    value="1"
                    <?= $artikel['status'] ? 'checked' : ''; ?>>

                <label for="status">
                    Publikasikan Artikel
                </label>
            </div>

            <div class="form-action">

                <button type="submit" class="btn btn-primary">
                    Update Artikel
                </button>

                <a href="<?= base_url('admin/artikel'); ?>" class="btn btn-secondary">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->include('template/admin_footer'); ?>
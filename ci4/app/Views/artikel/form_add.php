<?= $this->include('template/admin_header'); ?>

<div class="form-container">

    <div class="form-card">

        <div class="form-header">
            <h2>➕ Tambah Artikel</h2>
            <p>Buat artikel baru untuk website.</p>
        </div>

        <form
            action="<?= base_url('admin/artikel/add'); ?>"
            method="post"
            enctype="multipart/form-data">

            <div class="form-group">
                <label>Judul Artikel</label>
                <input
                    type="text"
                    name="judul"
                    class="form-control"
                    placeholder="Masukkan judul artikel..."
                    required>
            </div>

            <div class="form-group">
                <label>Kategori</label>

                <select
                    name="id_kategori"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    <?php foreach($kategori as $k): ?>
                    
                        <option
                            value="<?= $k['id_kategori']; ?>">
                    
                            <?= $k['nama_kategori']; ?>
                    
                        </option>
                    
                    <?php endforeach; ?>
                    
                </select>
                    
            </div>

            <div class="form-group">
                <label>Gambar Artikel</label>
                                
                <input
                    type="file"
                    name="gambar"
                    class="form-control"
                    accept="image/*">
                                
                <small class="form-text">
                    Format yang diperbolehkan: JPG, JPEG, PNG
                </small>
            </div>

            <div class="form-group">
                <label>Isi Artikel</label>
                <textarea
                    name="isi"
                    class="form-control"
                    rows="8"
                    placeholder="Tulis isi artikel..."
                    required></textarea>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="status" name="status" value="1">
                <label for="status">Publikasikan Artikel</label>
            </div>

            <div class="form-action">
                <button type="submit" class="btn btn-primary">
                    Simpan Artikel
                </button>

                <a href="<?= base_url('admin/artikel'); ?>" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->include('template/admin_footer'); ?>
<?= $this->include('template/header'); ?>

<div class="ajax-container">

    <div class="ajax-form-card">

        <div class="card-header">
            <h3>➕ Tambah Artikel Baru</h3>
            <p>Tambahkan artikel tanpa reload halaman.</p>
        </div>

        <form id="formTambah">

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
                <label>Isi Artikel</label>
                <textarea
                    name="isi"
                    class="form-control"
                    rows="5"
                    placeholder="Tulis isi artikel..."
                    required></textarea>
            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Simpan Artikel

            </button>

        </form>

    </div>


    <div class="ajax-table-card">

        <div class="page-header">
            <h2>📋 Data Artikel AJAX</h2>
            <p>Data akan diperbarui secara realtime tanpa reload halaman.</p>
        </div>

        <table class="table" id="artikelTable">

            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-judul">Judul Artikel</th>
                    <th class="col-kategori">Kategori</th>
                    <th class="col-status">Status</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="5" class="loading-row">
                        Loading data...
                    </td>
                </tr>
            </tbody>

        </table>

    </div>

</div>

<script src="<?= base_url('assets/js/jquery-4.0.0.min.js') ?>"></script>

<script>

$(document).ready(function(){

    // =====================
    // LOAD DATA
    // =====================
    function loadData()
    {
        $('#artikelTable tbody').html(`
            <tr>
                <td colspan="5" align="center">
                    Loading data...
                </td>
            </tr>
        `);

        $.ajax({

            url: "<?= base_url('ajax/getData') ?>",

            type: "GET",

            dataType: "json",

            success: function(data)
            {
                let html = '';

                $.each(data, function(i, row){

                    html += `
                    <tr>

                        <td>${row.id}</td>

                        <td>${row.judul}</td>

                        <td>
                            ${row.nama_kategori ?? '-'}
                        </td>

                        <td>
                            ${row.status == 1
                            ? '<span class="status-active">Aktif</span>'
                            : '<span class="status-draft">Draft</span>'}
                        </td>

                        <td>
                        
                            <div class="action-buttons">
                        
                                <button
                                    class="btn btn-warning edit"
                                    data-id="${row.id}">
                                    ✏️ Edit
                                </button>
                        
                                <button
                                    class="btn btn-danger delete"
                                    data-id="${row.id}">
                                    🗑 Hapus
                                </button>
                        
                            </div>
                        
                        </td>

                    </tr>
                    `;
                });

                $('#artikelTable tbody').html(html);
            },

            error: function()
            {
                $('#artikelTable tbody').html(`
                    <tr>
                        <td colspan="5" align="center">
                            Gagal memuat data.
                        </td>
                    </tr>
                `);
            }

        });
    }

    // Load pertama kali
    loadData();

    // =====================
    // TAMBAH DATA AJAX
    // =====================
    $('#formTambah').submit(function(e){

        e.preventDefault();

        $.ajax({

            url: "<?= base_url('ajax/add') ?>",

            type: "POST",

            data: $(this).serialize(),

            success: function(response)
            {
                alert('Artikel berhasil ditambahkan');

                $('#formTambah')[0].reset();

                loadData();
            },

            error: function()
            {
                alert('Gagal menambahkan artikel');
            }

        });

    });

    // =====================
    // HAPUS DATA AJAX
    // =====================
    $(document).on('click', '.delete', function(){

        let id = $(this).data('id');

        if(confirm('Yakin ingin menghapus artikel ini?'))
        {
            $.ajax({

                url: "<?= base_url('ajax/delete/') ?>" + id,

                type: "DELETE",

                success: function()
                {
                    alert('Artikel berhasil dihapus');

                    loadData();
                },

                error: function()
                {
                    alert('Gagal menghapus artikel');
                }

            });
        }

    });

    // =====================
    // EDIT DATA AJAX
    // =====================
    $(document).on('click', '.edit', function(){

        let id = $(this).data('id');

        let judul = prompt(
            'Edit Judul Artikel',
            $(this).data('judul')
        );

        if(judul == null) return;

        $.ajax({

            url: "<?= base_url('ajax/update/') ?>" + id,

            type: "POST",

            data: {
                judul: judul
            },

            success: function()
            {
                alert('Artikel berhasil diupdate');

                loadData();
            },

            error: function()
            {
                alert('Gagal update artikel');
            }

        });

    });

});

</script>

<?= $this->include('template/footer'); ?>
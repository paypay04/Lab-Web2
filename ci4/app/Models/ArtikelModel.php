<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul',
        'isi',
        'slug',
        'gambar',
        'status',
        'id_kategori'
    ];

    public function getArtikelDenganKategori($q = null)
    {
        $this->select('artikel.*, kategori.nama_kategori');

        $this->join(
            'kategori',
            'kategori.id_kategori = artikel.id_kategori',
            'left'
        );

        if ($q) {
            $this->like('artikel.judul', $q);
        }

        return $this;
    }
}
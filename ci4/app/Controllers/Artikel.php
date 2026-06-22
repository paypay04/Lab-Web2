<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    // Menampilkan daftar artikel (admin)
    public function admin_index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }

        $q = $this->request->getVar('q') ?? '';

        $model = new ArtikelModel();

        $model->getArtikelDenganKategori($q);

        $data = [
            'title'     => 'Daftar Artikel',
            'q'         => $q,
            'artikel'   => $model->paginate(5),
            'pager'     => $model->pager,
            'nama_user' => session()->get('user_name')
        ];

        return view('artikel/admin_index', $data);
    }
    
    // Form tambah artikel
    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }

        $kategoriModel = new KategoriModel();

        // Proses simpan
        if ($this->request->getMethod() === 'post') {

            $model = new ArtikelModel();

            $file = $this->request->getFile('gambar');
            $namaGambar = null;

            if ($file && $file->isValid()) {

                $namaGambar = $file->getRandomName();

                $file->move(
                    ROOTPATH . 'public/gambar',
                    $namaGambar
                );
            }

            $data = [
                'judul'        => $this->request->getPost('judul'),
                'isi'          => $this->request->getPost('isi'),
                'id_kategori'  => $this->request->getPost('id_kategori'),
                'status'       => $this->request->getPost('status') ? 1 : 0,
                'slug'         => url_title(
                                    $this->request->getPost('judul'),
                                    '-',
                                    true
                                 ),
                'gambar'       => $namaGambar
            ];

            $model->save($data);

            session()->setFlashdata(
                'success',
                'Artikel berhasil ditambahkan!'
            );

            return redirect()->to('/admin/artikel');
        }

        // Tampilkan form
        $data = [
            'title'    => 'Tambah Artikel Baru',
            'kategori' => $kategoriModel->findAll()
        ];

        return view('artikel/form_add', $data);
    }
    
    // Form edit artikel
    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }

        $artikelModel = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $data = [
            'title'    => 'Edit Artikel',
            'artikel'  => $artikelModel->find($id),
            'kategori' => $kategoriModel->findAll()
        ];

        return view('artikel/form_edit', $data);
    }
    
    // Proses update artikel
    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }

        $model = new ArtikelModel();

        $artikel = $model->find($id);

        $file = $this->request->getFile('gambar');

        $namaGambar = $artikel['gambar'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // hapus gambar lama
            if (
                !empty($artikel['gambar']) &&
                file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])
            ) {
                unlink(ROOTPATH . 'public/gambar/' . $artikel['gambar']);
            }

            $namaGambar = $file->getRandomName();

            $file->move(
                ROOTPATH . 'public/gambar',
                $namaGambar
            );
        }

        $data = [
            'judul'       => $this->request->getPost('judul'),
            'isi'         => $this->request->getPost('isi'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'status'      => $this->request->getPost('status') ? 1 : 0,
            'slug'        => url_title(
                                $this->request->getPost('judul'),
                                '-',
                                true
                            ),
            'gambar'      => $namaGambar
        ];

        $model->update($id, $data);

        session()->setFlashdata(
            'success',
            'Artikel berhasil diupdate!'
        );

        return redirect()->to('/admin/artikel');
    }
    
    // Hapus artikel
    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }

        $model = new ArtikelModel();

        $artikel = $model->find($id);

        if (
            !empty($artikel['gambar']) &&
            file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])
        ) {
            unlink(ROOTPATH . 'public/gambar/' . $artikel['gambar']);
        }

        $model->delete($id);

        session()->setFlashdata(
            'success',
            'Artikel berhasil dihapus!'
        );

        return redirect()->to('/admin/artikel');
    }
    
    // Menampilkan artikel untuk user biasa (public)
    public function index()
    {
        $model = new ArtikelModel();

        $artikel = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = artikel.id_kategori',
                'left'
            )
            ->findAll();

        $data = [
            'title'   => 'Daftar Artikel',
            'artikel' => $artikel
        ];

        return view('artikel/index', $data);
    }
    
    // Menampilkan detail artikel (public)
    public function view($slug)
    {
        $model = new ArtikelModel();

        $artikel = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = artikel.id_kategori',
                'left'
            )
            ->where('slug', $slug)
            ->first();

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'   => $artikel['judul'],
            'artikel' => $artikel
        ];

        return view('artikel/detail', $data);
    }
}
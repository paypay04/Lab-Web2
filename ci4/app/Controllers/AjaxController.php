<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class AjaxController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Artikel AJAX'
        ];

        return view('ajax/index', $data);
    }

    public function getData()
    {
        $model = new ArtikelModel();

        $data = $model
            ->select('artikel.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = artikel.id_kategori',
                'left'
            )
            ->findAll();

        return $this->response->setJSON($data);
    }

    public function save()
    {
        $model = new ArtikelModel();

        $data = [

            'judul' => $this->request->getPost('judul'),

            'isi' => $this->request->getPost('isi'),

            'slug' => url_title(
                $this->request->getPost('judul'),
                '-',
                true
            ),

            'status' => 1

        ];

        $model->insert($data);

        return $this->response->setJSON([
            'status' => 'success'
        ]);
        
    }

    public function delete($id)
    {
        $model = new ArtikelModel();

        $artikel = $model->find($id);

        if (!empty($artikel['gambar'])) {

            $path = ROOTPATH .
                    'public/gambar/' .
                    $artikel['gambar'];

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $model->delete($id);

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

    public function add()
    {
        $model = new ArtikelModel();
    
        $model->insert([
            'judul' => $this->request->getPost('judul'),
            'isi'   => $this->request->getPost('isi'),
            'slug'  => url_title(
                $this->request->getPost('judul'),
                '-',
                true
            ),
            'status' => 1
        ]);
    
        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }
    
    public function update($id)
    {
        $model = new ArtikelModel();
    
        $model->update($id, [
            'judul' => $this->request->getPost('judul')
        ]);
    
        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }
}
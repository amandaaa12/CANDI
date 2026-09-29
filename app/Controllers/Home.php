<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Berita',
            'berita' => $this->beritaModel
                ->orderBy('tanggal', 'DESC')
                ->findAll()
        ];

        return view('admin/berita', $data);
    }

    public function simpan()
    {
        $this->beritaModel->save([
            'judul'   => $this->request->getPost('judul'),
            'isi'     => $this->request->getPost('isi'),
            'tanggal' => $this->request->getPost('tanggal')
        ]);

        return redirect()
            ->to('/admin/berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Berita',
            'berita' => $this->beritaModel->find($id)
        ];

        if (!$data['berita']) {
            return redirect()
                ->to('/admin/berita')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin/edit_berita', $data);
    }

    public function update($id)
    {
        $this->beritaModel->update($id, [
            'judul'   => $this->request->getPost('judul'),
            'isi'     => $this->request->getPost('isi'),
            'tanggal' => $this->request->getPost('tanggal')
        ]);

        return redirect()
            ->to('/admin/berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->beritaModel->delete($id);

        return redirect()
            ->to('/admin/berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
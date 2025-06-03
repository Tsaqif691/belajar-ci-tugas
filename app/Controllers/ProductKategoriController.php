<?php

namespace App\Controllers;

use App\Models\ProductKategoriModel;

class ProductKategoriController extends BaseController
{
    protected $kategori;

    function __construct()
    {
        $this->kategori = new ProductKategoriModel();
    }

    public function index()
    {
        $data['productkategori'] = $this->kategori->findAll();
        return view('v_productkategori', $data);
    }


    public function create()
    {
        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->kategori->insert($dataForm);

        return redirect()->to('productkategori')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'description' => $this->request->getPost('description'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->kategori->update($id, $dataForm);
        return redirect()->to('productkategori')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->kategori->delete($id);
        return redirect()->to('productkategori')->with('success', 'Data berhasil dihapus');
    }
}

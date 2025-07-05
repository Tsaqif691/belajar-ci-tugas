<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    // Tampilkan semua diskon
    public function index()
    {
        $diskon = $this->diskonModel->orderBy('tanggal', 'ASC')->findAll();
        return view('v_diskon', ['diskon' => $diskon]);
    }

    // Tambah data diskon
    public function create()
    {
        $tanggal = $this->request->getPost('tanggal');
        $nominal = $this->request->getPost('nominal');

        // Validasi: tidak boleh ada tanggal yang sama
        $cek = $this->diskonModel->where('tanggal', $tanggal)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Tanggal diskon sudah tersedia!');
        }

        $this->diskonModel->save([
            'tanggal'   => $tanggal,
            'nominal'   => $nominal,
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('diskon'))->with('success', 'Diskon berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $diskon = $this->diskonModel->find($id);

        if (!$diskon) {
            return redirect()->to(base_url('diskon'))->with('error', 'Data tidak ditemukan');
        }

        return view('edit_diskon', ['diskon' => $diskon]);
    }

    // Proses update data diskon
    public function update($id)
    {
        $diskon = $this->diskonModel->find($id);

        if (!$diskon) {
            return redirect()->to(base_url('diskon'))->with('error', 'Data tidak ditemukan');
        }

        $this->diskonModel->update($id, [
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('diskon'))->with('success', 'Diskon berhasil diperbarui');
    }

    // Hapus data diskon
    public function delete($id)
    {
        $this->diskonModel->delete($id);
        return redirect()->to(base_url('diskon'))->with('success', 'Diskon berhasil dihapus');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    protected $table = 'diskon';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'nominal', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'id' => 'permit_empty|integer', // ← tambahkan ini
        'tanggal' => 'required|is_unique[diskon.tanggal,id,{id}]',
        'nominal' => 'required|numeric|greater_than[0]'
    ];


    protected $validationMessages = [
        'tanggal' => [
            'required' => 'Tanggal wajib diisi',
            'is_unique' => 'Diskon pada tanggal ini sudah ada'
        ],
        'nominal' => [
            'required' => 'Nominal wajib diisi',
            'numeric' => 'Nominal harus berupa angka',
            'greater_than' => 'Nominal harus lebih dari 0'
        ]
    ];
}
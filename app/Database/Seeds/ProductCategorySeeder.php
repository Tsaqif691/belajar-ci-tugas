<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'category_name' => 'Elektronik',
                'description'   => 'Berbagai produk elektronik seperti TV, Laptop, dll.',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'category_name' => 'Pakaian',
                'description'   => 'Berbagai jenis pakaian.',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'category_name' => 'Makanan',
                'description'   => 'Berbagai makanan dan minuman.',
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('product_category')->insertBatch($data);
    }
}

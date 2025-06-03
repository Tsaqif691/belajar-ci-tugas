<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProductKategoriModel extends Model
{
	protected $table = 'productkategori'; 
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'nama','description','created_at','updated_at'
	];  
}
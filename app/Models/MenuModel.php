<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

	protected $table = 'menu';
	protected $primaryKey = 'menu_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['menu_id', 'menu_name', 'menu_order', 'menu_link', 'menu_title', 'menu_keyword', 'menu_desc', 'menu_status'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}

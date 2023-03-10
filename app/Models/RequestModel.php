<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{

	protected $table = 'request';
	protected $primaryKey = 'request_id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['request_name', 'briefdescription', 'firstdate', 'seconddate', 'RequestStatus', 'file', 'Detail', 'user_user_id', 'user_lead'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}

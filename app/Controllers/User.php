<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;

class User extends BaseController
{

	protected $userModel;
	protected $validation;

	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'controller'    	=> 'user',
			'title'     		=> 'user'
		];

		return view('pages/user', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->userModel->select()->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class="btn btn-sm dropdown-toggle btn-dark" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i> ' .	lang("App.option")	. '</button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save(' . $value->user_id . ')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-orange" ><i class="fa-solid fa-copy"></i>   ' .  lang("App.copy")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->user_id . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div></div>';

			$data['data'][$key] = array(
				$value->user_id,
				$value->user_name,
				$value->user_email,
				$value->user_password,
				$value->user_date,
				$value->user_phone,
				$value->user_address,
				$value->user_type,
				$value->user_status,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('user_id');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->userModel->where('user_id', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();

		$fields['user_id'] = $this->request->getPost('user_id');
		$fields['user_name'] = $this->request->getPost('user_name');
		$fields['user_email'] = $this->request->getPost('user_email');
		$fields['user_password'] = $this->request->getPost('user_password');
		$fields['user_date'] = $this->request->getPost('user_date');
		$fields['user_phone'] = $this->request->getPost('user_phone');
		$fields['user_address'] = $this->request->getPost('user_address');
		$fields['user_type'] = $this->request->getPost('user_type');
		$fields['user_status'] = $this->request->getPost('user_status');


		$this->validation->setRules([
			'user_name' => ['label' => 'User name', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_email' => ['label' => 'User email', 'rules' => 'required|valid_email|min_length[0]|max_length[45]'],
			'user_password' => ['label' => 'User password', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_date' => ['label' => 'User date', 'rules' => 'required|valid_date|min_length[0]'],
			'user_phone' => ['label' => 'User phone', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_address' => ['label' => 'User address', 'rules' => 'required|min_length[0]'],
			'user_type' => ['label' => 'User type', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_status' => ['label' => 'User status', 'rules' => 'required|min_length[0]|max_length[45]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->userModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{
		$response = array();

		$fields['user_id'] = $this->request->getPost('user_id');
		$fields['user_name'] = $this->request->getPost('user_name');
		$fields['user_email'] = $this->request->getPost('user_email');
		$fields['user_password'] = $this->request->getPost('user_password');
		$fields['user_date'] = $this->request->getPost('user_date');
		$fields['user_phone'] = $this->request->getPost('user_phone');
		$fields['user_address'] = $this->request->getPost('user_address');
		$fields['user_type'] = $this->request->getPost('user_type');
		$fields['user_status'] = $this->request->getPost('user_status');


		$this->validation->setRules([
			'user_name' => ['label' => 'User name', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_email' => ['label' => 'User email', 'rules' => 'required|valid_email|min_length[0]|max_length[45]'],
			'user_password' => ['label' => 'User password', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_date' => ['label' => 'User date', 'rules' => 'required|valid_date|min_length[0]'],
			'user_phone' => ['label' => 'User phone', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_address' => ['label' => 'User address', 'rules' => 'required|min_length[0]'],
			'user_type' => ['label' => 'User type', 'rules' => 'required|min_length[0]|max_length[45]'],
			'user_status' => ['label' => 'User status', 'rules' => 'required|min_length[0]|max_length[45]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->userModel->update($fields['user_id'], $fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.update-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.update-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('params');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->userModel->where('user_id', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}
}

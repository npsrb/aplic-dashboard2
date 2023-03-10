<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RequestModel;
use App\Models\UserModel;


class Request extends BaseController
{

	protected $requestModel;
	protected $userModel;
	protected $validation;

	public function __construct()
	{
		$this->requestModel = new RequestModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'controller'    	=> 'request',
			'title'     		=> 'request',
			'controlleruser'    	=> 'user'
		];

		return view('pages/request', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		//$result = $this->requestModel->select()->findAll();
		$result = $this->requestModel->select()->where('user_user_id', session()->user_id)->findAll();

		foreach ($result as $key => $value) {


			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class="btn btn-sm dropdown-toggle btn-dark" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i> ' .	lang("App.option")	. '</button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save(' . $value->request_id . ')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->request_id . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';

			$ops .= '</div></div>';

			$data['data'][$key] = array(
				$value->request_id,
				$value->request_name,
				$value->briefdescription,
				$value->firstdate,
				$value->seconddate,
				$value->file,
				$value->Detail,
				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getInformPeopl1()
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
				$value->leaveamount,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('request_id');

		if ($this->validation->check($id, 'required')) {

			$data = $this->requestModel->where('request_id', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['request_id'] = '123';
		$fields['request_name'] = $this->request->getPost('request_name');
		$fields['briefdescription'] = $this->request->getPost('briefdescription');
		$fields['firstdate'] = $this->request->getPost('firstdate');
		$fields['seconddate'] = $this->request->getPost('seconddate');
		$fields['Detail'] = 'Full Name : ' . session()->user_name . ' Sick Date : ' . $fields['firstdate'] . ' - ' . $fields['seconddate'] . ' Total Sick Leave : ' . session()->leaveamount . '';
		$fields['RequestStatus'] = 'Not Approve';
		$fields['file'] = 'file';
		$fields['user_user_id'] = $this->request->getPost('user_user_id');
		$fields['user_lead'] = $this->request->getPost('user_lead');


		$this->validation->setRules([
			'request_name' => ['label' => 'Request name', 'rules' => 'required|min_length[0]|max_length[50]'],
			'briefdescription' => ['label' => 'Briefdescription', 'rules' => 'required|min_length[0]'],
			'firstdate' => ['label' => 'Firstdate', 'rules' => 'required|valid_date|min_length[0]'],
			'seconddate' => ['label' => 'Seconddate', 'rules' => 'required|valid_date|min_length[0]'],
			'RequestStatus' => ['label' => 'RequestStatus', 'rules' => 'required|min_length[0]|max_length[50]'],
			'file' => ['label' => 'File', 'rules' => 'required|min_length[0]|max_length[45]'],
			'Detail' => ['label' => 'Detail', 'rules' => 'required|min_length[0]'],
			'user_user_id' => ['label' => 'User user id', 'rules' => 'permit_empty|min_length[0]|max_length[20]'],
			'user_lead' => ['label' => 'user_lead', 'rules' => 'required|min_length[0]|max_length[50]'],
		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		}
		if ($fields['firstdate'] >= $fields['seconddate']) {
			$response['success'] = false;
			$response['messages'] = lang("Start date must be greater than end date");
		} else {

			if ($this->requestModel->insert($fields)) {

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
		$fields['request_id'] = '123';
		$fields['request_name'] = $this->request->getPost('request_name');
		$fields['briefdescription'] = $this->request->getPost('briefdescription');
		$fields['firstdate'] = $this->request->getPost('firstdate');
		$fields['seconddate'] = $this->request->getPost('seconddate');
		$fields['Detail'] = 'Full Name : ' . session()->user_name . ' Sick Date : ' . $fields['firstdate'] . ' - ' . $fields['seconddate'] . ' Total Sick Leave : ' . session()->leaveamount . '';
		$fields['RequestStatus'] = 'Not Approve';
		$fields['file'] = 'file';
		$fields['user_user_id'] = $this->request->getPost('user_user_id');
		$fields['user_lead'] = $this->request->getPost('user_lead');

		$this->validation->setRules([
			'request_name' => ['label' => 'Request name', 'rules' => 'required|min_length[0]|max_length[50]'],
			'briefdescription' => ['label' => 'Briefdescription', 'rules' => 'required|min_length[0]'],
			'firstdate' => ['label' => 'Firstdate', 'rules' => 'required|valid_date|min_length[0]'],
			'seconddate' => ['label' => 'Seconddate', 'rules' => 'required|valid_date|min_length[0]'],
			'RequestStatus' => ['label' => 'RequestStatus', 'rules' => 'required|min_length[0]|max_length[50]'],
			'file' => ['label' => 'File', 'rules' => 'required|min_length[0]|max_length[45]'],
			'Detail' => ['label' => 'Detail', 'rules' => 'required|min_length[0]'],
			'user_user_id' => ['label' => 'User user id', 'rules' => 'permit_empty|min_length[0]|max_length[20]'],
			'user_lead' => ['label' => 'user_lead', 'rules' => 'required|min_length[0]|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->requestModel->update($fields['request_id'], $fields)) {

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

			if ($this->requestModel->where('request_id', $id)->delete()) {

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

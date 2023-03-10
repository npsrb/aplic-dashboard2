<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RequestModel;
use CodeIgniter\CLI\Console;

class RequestApproval extends BaseController
{

	protected $requestModel;
	protected $validation;

	public function __construct()
	{
		$this->requestModel = new RequestModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'controller'    	=> 'requestApproval',
			'title'     		=> 'request Approval'
		];

		return view('pages/requestApproval', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->requestModel->select()->where('RequestStatus', 'Not Approve')->findAll();
		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class="btn btn-danger btn-icon-split" onClick="accept(' . $value->request_id . ')">  ' .  lang("Approve")  . '</a>';
			$ops .= '</div>';

			$ips = '<div class="btn-group">';
			$ips .= '<button type="button" class="btn btn-danger btn-icon-split" onClick="reject(' . $value->request_id . ')">  ' .  lang("Reject")  . '</a>';
			$ips .= '</div>';
			$data['data'][$key] = array(
				$value->request_id,
				$value->request_name,
				$value->briefdescription,
				$value->firstdate,
				$value->seconddate,
				$value->RequestStatus,
				$value->Detail,
				$ops,
				$ips
			);
		}

		return $this->response->setJSON($data);
	}

	public function accept()
	{
		$response = array();
		$id = $this->request->getPost();
		$this->requestModel->update($id, ['RequestStatus' => 'Approve']);
		$response['success'] = true;
		$response['messages'] = "Approve";

		return $this->response->setJSON($response);
	}

	public function reject()
	{
		$response = array();
		$id = $this->request->getPost();
		$this->requestModel->update($id, ['RequestStatus' => 'Reject']);
		$response['success'] = true;
		$response['messages'] = "Rejected";

		return $this->response->setJSON($response);
	}
	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('request_id');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->requestModel->where('request_id', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
}

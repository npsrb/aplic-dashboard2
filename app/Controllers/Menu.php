<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MenuModel;

class Menu extends BaseController
{

	protected $menuModel;
	protected $validation;

	public function __construct()
	{
		$this->menuModel = new MenuModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$totalMenu = count($this->menuModel->findAll()) + 1;
		$id = md5("MN" . substr("000" . $totalMenu, -3));

		$data = [
			'controller'    	=> 'menu',
			'title'     		=> 'menu',
			'id'				=> $id
		];

		return view('pages/menu', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->menuModel->select()->orderBy('menu_order', 'asc')->findAll();

		$index = 1;
		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class="btn btn-sm dropdown-toggle btn-dark" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i> ' .	lang("App.option")	. '</button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save(' . $value->menu_id . ')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-orange" ><i class="fa-solid fa-copy"></i>   ' .  lang("App.copy")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->menu_id . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div></div>';


			$data['data'][$key] = array(
				$index++,
				$value->menu_id,
				$value->menu_name,
				$value->menu_order,
				$value->menu_link,
				$value->menu_title,
				$value->menu_keyword,
				$value->menu_desc,
				$value->menu_status,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('menu_id');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->menuModel->where('menu_id', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['menu_id'] = $this->request->getPost('menu_id');
		$fields['menu_name'] = $this->request->getPost('menu_name');
		$fields['menu_order'] = $this->request->getPost('menu_order');
		$fields['menu_link'] = $this->request->getPost('menu_link');
		$fields['menu_title'] = $this->request->getPost('menu_title');
		$fields['menu_keyword'] = $this->request->getPost('menu_keyword');
		$fields['menu_desc'] = $this->request->getPost('menu_desc');
		$fields['menu_status'] = $this->request->getPost('menu_status');


		$this->validation->setRules([
			'menu_name' => ['label' => 'Menu name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
			'menu_order' => ['label' => 'Menu order', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
			'menu_link' => ['label' => 'Menu link', 'rules' => 'required|min_length[0]|max_length[45]'],
			'menu_title' => ['label' => 'Menu title', 'rules' => 'permit_empty|min_length[0]|max_length[255]'],
			'menu_keyword' => ['label' => 'Menu keyword', 'rules' => 'permit_empty|min_length[0]|max_length[255]'],
			'menu_desc' => ['label' => 'Menu desc', 'rules' => 'permit_empty|min_length[0]|max_length[255]'],
			'menu_status' => ['label' => 'Menu status', 'rules' => 'required|min_length[0]|max_length[45]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->menuModel->insert($fields)) {

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

		$fields['menu_id'] = $this->request->getPost('menu_id');
		$fields['menu_name'] = $this->request->getPost('menu_name');
		$fields['menu_order'] = $this->request->getPost('menu_order');
		$fields['menu_link'] = $this->request->getPost('menu_link');
		$fields['menu_title'] = $this->request->getPost('menu_title');
		$fields['menu_keyword'] = $this->request->getPost('menu_keyword');
		$fields['menu_desc'] = $this->request->getPost('menu_desc');
		$fields['menu_status'] = $this->request->getPost('menu_status');


		$this->validation->setRules([
			'menu_name' => ['label' => 'Menu name', 'rules' => 'permit_empty|min_length[0]|max_length[45]'],
			'menu_order' => ['label' => 'Menu order', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
			'menu_link' => ['label' => 'Menu link', 'rules' => 'required|min_length[0]|max_length[45]'],
			'menu_title' => ['label' => 'Menu title', 'rules' => 'permit_empty|min_length[0]|max_length[255]'],
			'menu_keyword' => ['label' => 'Menu keyword', 'rules' => 'permit_empty|min_length[0]|max_length[255]'],
			'menu_desc' => ['label' => 'Menu desc', 'rules' => 'permit_empty|min_length[0]|max_length[255]'],
			'menu_status' => ['label' => 'Menu status', 'rules' => 'required|min_length[0]|max_length[45]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->menuModel->update($fields['menu_id'], $fields)) {

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

			if ($this->menuModel->where('menu_id', $id)->delete()) {

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

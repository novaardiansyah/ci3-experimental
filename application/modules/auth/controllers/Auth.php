<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$data = [
			'title' => 'Login',
			'content' => 'auth',
			'page' => 'login-page',
		];

		$this->load->view('auth/layouts/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/layouts/footer');
	}

	public function register()
	{
		$data = [
			'title'   => 'Register',
			'content' => 'auth/register',
			'page'    => 'register-page',
			'script'  => [
				'assets/js/auth/register.js',
			],
		];

		$this->load->view('auth/layouts/header', $data);
		$this->load->view('auth/register');
		$this->load->view('auth/layouts/footer');
	}

	public function process_register()
	{
		$rules = $this->_rules_register();

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == false) {
			$dataErrors = [
				'status'  => false,
				'errors'  => $this->form_validation->error_array(),
				'message' => 'error validation (codeigniter)',
			];

			echo json_encode($dataErrors);
		} else {
			$data = [
				'fullname' => $this->input->post('fullname'),
				'email'    => $this->input->post('email'),
				'password' => $this->input->post('password'),
			];

			echo json_encode(['status' => true, 'data' => $data]);
		}
	}

	/**
	 * ! Utils (Start)
	 * ? only for function or utility fractions
	 */

	private function _rules_register()
	{
		$rules = [
			[
				'field' => 'fullname',
				'label' => 'Fullname',
				'rules' => 'required|trim',
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|valid_emails',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|trim|min_length[8]',
			],
			[
				'field' => 'confirm_password',
				'label' => 'Confirm Password',
				'rules' => 'required|trim|matches[password]',
			]
		];

		return $rules;
	}
	// ! Utils (End)
}

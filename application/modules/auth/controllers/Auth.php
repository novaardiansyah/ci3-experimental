<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users');
	}

	/**
	 * ! Login (Start)
	 */
	public function index()
	{
		$data = [
			'title'   => 'Login',
			'content' => 'auth',
			'page'    => 'login-page',
			'script'  => [
				'assets/js/auth/login.js',
			],
		];

		$this->load->view('auth/layouts/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/layouts/footer');
	}

	public function process_login($type = null)
	{
		$rules = $this->_rules_login();

		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == false) {
			$dataErrors = [
				'status'  => false,
				'errors'  => $this->form_validation->error_array(),
				'message' => 'error validation (codeigniter)',
			];

			echo json_encode($dataErrors);
		} else if ($type == 'validation') {
			echo json_encode([
				'status'  => true,
				'message' => 'Congratulations your data validation is successful.',
				'type'    => 'validation'
			]);
		} else if ($type == 'process') {
			$send = [
				'email'    => $this->input->post('email'),
				'password' => $this->input->post('password'),
			];

			$result = $this->M_users->login($send);

			if ($result['status'] == true) {
				$data = $result['data'];

				$data_session = [
					'user_id'          => $data['id'],
					'user_fullname'    => $data['fullname'],
					'user_email'       => $data['email'],
					'user_role_id'     => $data['role_id'],
					'user_flag_active' => $data['flag_active'],
				];

				$this->session->set_userdata($data_session);

				echo json_encode([
					'status'   => true,
					'message'  => 'Congrats you successfully logged in.',
					'data'     => $data,
					'type'     => 'process',
					'redirect' => base_url('dashboard')
				]);
			} else {
				echo json_encode([
					'status'  => false,
					'message' => 'Sorry your email or password is wrong.',
					'data'    => $send,
					'errors'  => null
				]);
			}
		}
	}
	// ! Login (End)

	/**
	 * ! Register (Start)
	 */
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

	public function process_register($type = null)
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
		} else if ($type == 'validation') {
			echo json_encode([
				'status'  => true,
				'message' => 'Congratulations your data validation is successful.',
				'type'    => 'validation'
			]);
		} else if ($type == 'process') {
			$send = [
				'fullname' => $this->input->post('fullname'),
				'email'    => $this->input->post('email'),
				'password' => $this->input->post('password'),
			];

			$result = $this->M_users->register($send);
			echo json_encode($result);
		}
	}
	// ! Register (End)

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

	private function _rules_login()
	{
		$rules = [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|valid_emails',
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|trim|min_length[8]',
			]
		];

		return $rules;
	}
	// ! Utils (End)
}

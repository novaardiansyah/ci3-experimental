<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users', 'users');
	}

	/**
	 * ! Login (Start)
	 */
	public function index()
	{
		is_login(true);

		$data = [
			'title'   => 'Login',
			'content' => 'auth',
			'page'    => 'login-page',
			'script'  => [
				base_url('assets/js/auth/login.js'),
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

		if ($this->form_validation->run() !== false && $type == 'process') {
			$send = [
				'email'    => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'remember' => $this->input->post('remember'),
			];

			$result = $this->users->login($send);

			if ($result['status'] == true) {
				set_session([
					'user_data'   => $result['data'],
					'user_cookie' => $result['cookie']
				]);
			}

			echo json_encode($result);
		} else {
			echo json_encode([
				'status'  => false,
				'errors'  => $this->form_validation->error_array(),
				'message' => 'error validation (codeigniter)',
			]);
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
				base_url('assets/js/auth/register.js'),
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

		if ($this->form_validation->run() !== false) {
			$focus = isset($_POST['focus']) ? $_POST['focus'] : '';
			if ($focus) {
				echo json_encode(['status' => true]);
				return;
			}

			$result = $this->users->register([
				'fullname' => isset($_POST['fullname']) ? trim($_POST['fullname']) : '',
				'email'    => isset($_POST['email']) ? trim($_POST['email']) : '',
				'password' => isset($_POST['password']) ? trim($_POST['password']) : '',
			]);

			echo json_encode($result);
		} else {
			echo json_encode([
				'status'  => false,
				'errors'  => $this->form_validation->error_array(),
				'message' => 'error validation (codeigniter)',
			]);
		}

		return;
	}
	// ! Register (End)

	/**
	 * ! Logout (Start)
	 */
	public function logout()
	{
		destroy_cookie('login');
		destroy_session(['user_data', 'user_cookie'], 'array');
		redirect('auth');
	}
	// ! Logout (End)

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
				'rules' => 'required|trim|min_length[3]|max_length[30]',
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|valid_emails|min_length[3]|max_length[30]|is_unique[users.email]',
				'errors' => [
					'is_unique' => 'This email is already registered.',
				],
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|trim|min_length[6]',
			],
			[
				'field' => 'confirm_password',
				'label' => 'Confirm Password',
				'rules' => 'required|trim|min_length[6]|matches[password]',
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
				'rules' => 'required|trim|alpha_numeric',
			]
		];

		return $rules;
	}
	// ! Utils (End)
}

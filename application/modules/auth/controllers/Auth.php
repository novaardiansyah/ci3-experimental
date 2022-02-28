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
			'title' => 'Register',
			'content' => 'auth/register',
			'page' => 'register-page',
		];

		$this->load->view('auth/layouts/header', $data);
		$this->load->view('auth/register');
		$this->load->view('auth/layouts/footer');
	}
}

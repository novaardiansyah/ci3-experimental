<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users', 'users');
		$this->load->model('M_cookies', 'cookies');

		is_login();
	}

	public function index()
	{
		echo 'dashboard';
	}
}

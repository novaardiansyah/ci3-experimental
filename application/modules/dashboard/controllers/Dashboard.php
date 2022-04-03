<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users');
	}

	public function index()
	{
		if (get_session('user_cookie') !== null) {
			$cookie = get_session('user_cookie');
			setcookie($cookie['name'], $cookie['cookie'], get_times($cookie['expired_at']));
		}

		var_dump(get_session('user_cookie'));
	}
}

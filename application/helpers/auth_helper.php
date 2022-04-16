<?php defined('BASEPATH') or exit('No direct script access allowed');

function is_login($already = false)
{
  $ci = get_instance();
  check_cookie('login');

  $user = $ci->session->userdata('user_data');

  if (!empty($user)) {
    if ($already == true) {
      redirect('dashboard');
    } else {
      return true;
    }
  } else {
    $ci->session->set_flashdata('warning', 'Sorry, you have to login first.');
    redirect('auth');
  }
}

function check_cookie($name = 'cookie')
{
  $ci = get_instance();

  $ci->load->model('M_users', 'users');
  $ci->load->model('M_cookies', 'cookies');

  if (get_session('user_cookie') !== null) {
    $cookie = get_session('user_cookie');
    setcookie($cookie['name'], $cookie['cookie'], get_times($cookie['expired_at']));

    destroy_session('user_cookie');
  }

  $get_cookie = get_cookie(getenv('PREFIX') . '-' . $name);
  if (!empty($get_cookie)) {
    $cookie = $ci->cookies->get_cookie($get_cookie, 'cookie');

    if ($cookie['status'] == true) {
      $user = $ci->users->get_user($cookie['data']['users_id'], 'id');
      if ($user['status'] == true) {
        set_session('user_data', $user['data']);
      }
    }

    return true;
  }

  return false;
}

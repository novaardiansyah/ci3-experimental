<?php defined('BASEPATH') or exit('No direct script access allowed');

function is_login($already = false)
{
  $ci = get_instance();

  check_cookie('login');

  $user = $ci->session->userdata('user_data');

  if (!empty($user)) {
    if ($already == false) {
      return true;
    } else {
      redirect('dashboard');
    }
  } else {
    if ($already == true) {
      return true;
    } else {
      $ci->session->set_flashdata('warning', 'Sorry, you have to login first.');
      return redirect('auth');
    }
  }
}

function check_cookie($name)
{
  $ci = get_instance();

  $ci->load->model('M_users', 'users');
  $ci->load->model('M_cookies', 'cookies');

  if (get_session('user_cookie') !== null) {
    $cookie = get_session('user_cookie');
    setcookie($cookie['name'], $cookie['cookie'], get_times($cookie['expired_at']));

    return destroy_session('user_cookie');
  } else {
    $current_cookie = get_cookie(getenv('PREFIX') . '-' . $name);

    if ($current_cookie) {
      $cookie = $ci->cookies->get_cookie([
        'cookie' => $current_cookie
      ]);

      if ($cookie['status'] == true) {
        $user = $ci->users->get_user($cookie['data']->id, 'id');

        if ($user['status'] == true) {
          set_session('user_data', $user['data']);
        }

        return true;
      }

      return false;
    }

    return false;
  }

  return false;
}

function destroy_cookie($name = null, $type = 'normal')
{
  $ci = get_instance();

  $ci->load->model('M_cookies', 'cookies');
  $ci->load->model('M_users', 'users');

  $user = get_session('user_data');

  if ($type == 'array') {
    $response = [];

    foreach ($name as $key => $value) {
      $name = $value ? getenv('PREFIX') . '-' . $value : getenv('PREFIX') . '-cookie';

      $delete_cookie = $ci->cookies->delete_cookie([
        'users_id' => $user['id'],
        'name'     => $name
      ]);

      $response[$key] = $delete_cookie;
    }

    return $response;
  } else {
    $name = $name ? getenv('PREFIX') . '-' . $name : getenv('PREFIX') . '-cookie';

    $delete_cookie = $ci->cookies->delete_cookie([
      'users_id' => $user['id'],
      'name'     => $name
    ]);

    return $delete_cookie;
  }

  return true;
}

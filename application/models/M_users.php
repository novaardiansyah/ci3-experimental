<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_user($params, $type)
  {
    if ($type == 'id') {
      $data = $this->db->get_where('users', ['id' => $params])->row_array();
    }

    if (!empty($data)) {
      $result = [
        'status' => true,
        'data'   => $data,
        'message' => 'Successfully get user.'
      ];
    } else {
      $result = [
        'status' => false,
        'data'   => null,
        'message' => 'User not found.'
      ];
    }

    return $result;
  }

  /**
   * ! Login (Start)
   */
  public function login($data)
  {
    $email    = $data['email'];
    $remember = isset($data['remember']) ? true : false;
    $user     = $this->db->get_where('users', ['email' => $email])->row_array();

    if (!$user) {
      $result = [
        'status'  => false,
        'data'    => null,
        'message' => 'Email or password is wrong.'
      ];

      return $result;
    }

    if (password_verify($data['password'], $user['password'])) {
      if ($remember == true) {
        $cookie = $this->db->get_where('cookies', ['users_id' => $user['id']])->row_array();

        if ($cookie !== null) {
          $update_cookie = [
            'updated_at' => get_datetimes('now'),
            'expired_at' => get_datetimes('+3 days')
          ];

          $this->db->update('cookies', $update_cookie, ['users_id' => $user['id']]);
        } else {
          $store_cookie = [
            'users_id'   => $user['id'],
            'name'       => getenv('PREFIX') . '-login',
            'cookie'     => hash('sha256', $user['email'] . getenv('CODE_PREFIX')),
            'expired_at' => get_datetimes('+3 days')
          ];

          $this->db->insert('cookies', $store_cookie);
        }
      }

      $cookie = $this->db->get_where('cookies', ['users_id' => $user['id']])->row();

      $result = [
        'status'   => true,
        'message'  => 'Congrats you successfully logged in.',
        'data'     => $user,
        'cookie'   => $remember ? $cookie : null,
        'type'     => 'process',
      ];
    } else {
      $result = [
        'status'  => false,
        'data'    => null,
        'message' => 'Email or password is wrong.'
      ];
    }

    return $result;
  }
  // ! Login (end)

  /**
   * ! Register (Start)
   */
  public function register($data)
  {
    $data_store = [
      'id'          => generate_uidv4(),
      'fullname'    => $data['fullname'],
      'email'       => $data['email'],
      'password'    => password_hash($data['password'], PASSWORD_DEFAULT),
      'role_id'     => 1,
      'flag_active' => 1,
    ];

    $store = $this->db->insert('users', $data_store);

    if ($store) {
      $result = [
        'status'   => true,
        'message'  => 'You have successfully registered, please check your email for verification.',
        'data'     => $data_store,
        'type'     => 'process',
      ];
    } else {
      $result = [
        'status'  => false,
        'message' => 'Failed to register, please try again.',
        'data'    => $data_store,
        'errors'  => ['code' => 'AU12JK']
      ];
    }

    return $result;
  }
  // ! Register (End)
}

<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function register($data)
  {
    $data_store = [
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
        'redirect' => base_url('auth')
      ];
    } else {
      $result = [
        'status'  => false,
        'message' => 'Failed to register, please try again.',
        'data'    => $data_store,
        'errors'  => null
      ];
    }

    return $result;
  }
}

<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_cookies extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_cookie($params = [], $type = null)
  {
    $where = '';

    foreach ($params as $key => $value) {
      $where .= "AND $key = '$value' ";
    }

    $cookie = $this->db->query("SELECT * FROM cookies WHERE flag_active = 1 $where")->row();

    if (!empty($cookie)) {
      if ($cookie->expired_at == get_datetimes('now')) {
        $this->db->delete('cookies', ['cookie' => $cookie['cookie']]);

        $result = [
          'status'  => false,
          'data'    => $cookie,
          'message' => 'Your cookie has been expired.'
        ];
      } else {
        $result = [
          'status'  => true,
          'data'    => $cookie,
          'message' => 'Successfully get cookie.'
        ];
      }
    } else {
      $result = [
        'status'  => false,
        'data'    => null,
        'message' => 'Cookie not found.'
      ];
    }

    return $result;
  }

  public function delete_cookie($params = [])
  {
    $where = '';

    foreach ($params as $key => $value) {
      $where .= "AND $key = '$value' ";
    }

    $cookie = $this->db->query("SELECT * FROM cookies WHERE flag_active = 1 $where")->row();

    if (!empty($cookie)) {
      $this->db->delete('cookies', ['cookie' => $cookie->cookie]);

      $result = [
        'status'  => true,
        'data'    => $cookie,
        'message' => 'Successfully delete cookie.'
      ];
    } else {
      $result = [
        'status'  => false,
        'data'    => null,
        'message' => 'Cookie not found.'
      ];
    }

    return $result;
  }
}

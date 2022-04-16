<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_cookies extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_cookie($params, $type)
  {
    if ($type == 'cookie') {
      $cookie = $this->db->get_where('cookies', ['cookie' => $params])->row_array();
      if (!empty($cookie)) {
        if ($cookie['expired_at'] == get_datetimes('now')) {
          $this->db->delete('cookies', ['cookie' => $cookie['cookie']]);

          $result = [
            'status' => false,
            'data'   => null,
            'message' => 'Your cookie has been expired.'
          ];
        } else {
          $result = [
            'status' => true,
            'data'   => $cookie,
            'message' => 'Successfully get cookie.'
          ];
        }
      } else {
        $result = [
          'status' => false,
          'data'   => null,
          'message' => 'Cookie not found.'
        ];
      }
    }

    return $result;
  }
}

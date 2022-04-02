<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('rest', ['server' => config_item('api_url')]);
  }

  public function register($data)
  {
    return $this->rest->post('user/register', ['data' => $data]);
  }
}

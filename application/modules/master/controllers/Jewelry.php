<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jewelry extends CI_Controller
{
  public function index()
  {
    $data = [
      'title' => 'Master Jewelry',
      'content' => 'master/jewelry',
    ];

    $this->load->view('master/layouts/header', $data);
    $this->load->view('master/layouts/navbar');
    $this->load->view('master/layouts/sidebar');
    $this->load->view('master/jewelry/index');
    $this->load->view('master/layouts/footer');
  }

  public function upload_video($id = null)
  {
    $data = [
      'title' => 'Upload Video',
      'content' => 'master/jewelry/upload_video',
    ];

    $this->load->view('master/layouts/header', $data);
    $this->load->view('master/layouts/navbar');
    $this->load->view('master/layouts/sidebar');
    $this->load->view('master/jewelry/upload_video');
    $this->load->view('master/layouts/footer');
  }
}

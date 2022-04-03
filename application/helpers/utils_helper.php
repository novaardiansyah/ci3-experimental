<?php defined('BASEPATH') or exit('No direct script access allowed');

function get_times($date = 'now')
{
  date_default_timezone_set('Asia/Jakarta');
  return date('Y-m-d H:i:s', strtotime($date));
}

<?php defined('BASEPATH') or exit('No direct script access allowed');

function get_datetimes($date = 'now')
{
  date_default_timezone_set('Asia/Jakarta');
  return date('Y-m-d H:i:s', strtotime($date));
}

function get_times($date = 'now')
{
  date_default_timezone_set('Asia/Jakarta');
  return strtotime($date);
}

function get_session($name = 'session')
{
  $ci = get_instance();
  return $ci->session->userdata($name);
}

function destroy_session($name = 'session')
{
  $ci = get_instance();
  return $ci->session->unset_userdata($name);
}

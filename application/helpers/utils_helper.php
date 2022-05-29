<?php defined('BASEPATH') or exit('No direct script access allowed');

function get_datetimes($date = 'now', $format = 'Y-m-d H:i:s')
{
  date_default_timezone_set('Asia/Jakarta');
  return date($format, strtotime($date));
}

function get_times($date = 'now')
{
  date_default_timezone_set('Asia/Jakarta');
  return strtotime($date);
}

function cv_times($date, $format = 'Y-m-d H:i:s')
{
  date_default_timezone_set('Asia/Jakarta');
  return date($format, $date);
}

function get_session($name = 'session')
{
  $ci = get_instance();
  return $ci->session->userdata($name);
}

function destroy_session($name)
{
  $ci = get_instance();
  return $ci->session->unset_userdata($name);
}

function set_session($name = null, $value = null, $type = 'normal')
{
  $ci = get_instance();

  if ($type == 'array') {
    $ci->session->set_userdata($value);
  } else {
    return $ci->session->set_userdata($name, $value);
  }
}

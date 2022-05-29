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

function set_session($name)
{
  $ci = get_instance();
  return $ci->session->set_userdata($name);
}

function generate_uidv4()
{
  // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
  $data = openssl_random_pseudo_bytes(16);
  assert(strlen($data) == 16);

  // Set version to 0100
  $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
  // Set bits 6-7 to 10
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

  // Output the 36 character UUID.
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

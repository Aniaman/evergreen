<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_model
{

  public function loginAdmin($user, $pass, $role)
  {

    $q = $this->db->where(['Email' => $user, 'Password' => $pass, 'Role' => $role])
      ->get('users');

    if ($q->num_rows()) {
      return $q->result_array();
    } else {
      return false;
    }
  }

  public function loginAgent($user, $pass, $role)
  {

    $q = $this->db->where(['email' => $user, 'password' => $pass, 'role' => $role])
      ->get('agent');

    if ($q->num_rows()) {
      $r = $q->result_array();
      return $r;
    } else {
      return false;
    }
  }

  public function loginCustomer($user, $pass)
  {

    $q = $this->db->where(['email' => $user, 'password' => $pass])
      ->get('customer');

    if ($q->num_rows()) {
      $r = $q->result_array();
      return $r;
    } else {
      return false;
    }
  }
}

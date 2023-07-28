<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('LoginModel');
    $this->load->model('General_model');
    $this->load->library('session');
  }

  public function index()
  {
    $user = $this->input->post('username');
    $pass = $this->input->post('password');
    $role = $this->input->post('role');
    $this->form_validation->set_rules('username', 'Email Id/User Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == TRUE) {

      if ($role == 'Admin') {
        $r = $this->LoginModel->loginAdmin($user, $pass, $role);
        if ($r) {

          $this->session->set_userdata('admin_id', $r[0]['id']);
          return redirect('Admin-Success');
        } else {
          $this->session->set_flashdata('Loginfailed', 'Invalid Username/Password');
          return redirect('Failed');
        }
      } else if ($role == 'Agent') {
        $r = $this->LoginModel->loginAgent($user, $pass, $role);

        if ($r) {

          $this->session->set_userdata('agent_id', $r[0]['id']);

          return redirect('Agent-Success');
        } else {
          return redirect('Failed');
        }
      } else if ($role == 'Sales Coordinator') {
        $r = $this->LoginModel->loginAgent($user, $pass, $role);

        if ($r) {
          $this->session->set_userdata('sales_cod_id', $r[0]['id']);

          return redirect('Sales-DashBoard');
        } else {
          return redirect('Failed');
        }
      } else if ($role == 'finance') {
        $r = $this->LoginModel->loginAgent($user, $pass, $role);

        if ($r) {

          $this->session->set_userdata('finance_id', $r[0]['id']);

          return redirect('Finance-DashBoard');
        } else {
          return redirect('Failed');
        }
      } else {
        $r = $this->LoginModel->loginCustomer($user, $pass);
        if ($r) {

          $this->session->set_userdata('customer_id', $r[0]['id']);

          return redirect('Customer-DashBoard');
        } else {
          return redirect('Customer');
        }
      }
    }
  }
  public function fail()
  {
    $this->load->view('Admin/index');
  }

  public function register()
  {
    $this->load->view('register');
  }

  public function registerAction()
  {
    $post = $this->input->post();
    $this->load->helper('string');
    $val = random_string('numeric', 5);
    $agentId = "EGS" . $val;
    $registerData = array(
      'AgentId' => $agentId,
      'name' => $post['fullname'],
      'phone' => $post['phone'],
      'email' => $post['email'],
      'address' => $post['address'],
      'password' => $post['password'],
      'role' => $post['role'],
    );
    $success = $this->General_model->insert('agent', $registerData);
    if (!empty($success)) {
      $this->session->set_flashdata('Success', 'Registration Successful');
      return redirect('Login');
    } else {
      $this->session->set_flashdata('Loginfailed', 'unable to register');
      return redirect('Register');
    }
  }

  public function logout()
  {
    session_destroy();
    return redirect('Login');
  }
  public function logoutCustomer()
  {
    session_destroy();
    return redirect('Customer');
  }
}

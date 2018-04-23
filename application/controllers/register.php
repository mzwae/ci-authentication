<?php

class Register extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('security');
    $this->load->model('Register_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');

  }

  public function index(){
    // Set validation rules
    $this->form_validation->set_rules('usr_fname', 'User First Name', 'required');
    $this->form_validation->set_rules('usr_lname', 'User Last Name', 'required');
    $this->form_validation->set_rules('usr_email', 'User Email', 'required|valid_email|is_unique[users.usr_email]');

    // Begin validation
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');//header with login link
      $this->load->view('users/register');
      $this->load->view('templates/footer');
    } else {
      # code...
    }

  }
}

 ?>

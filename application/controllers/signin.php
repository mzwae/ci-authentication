<?php

class Signin extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
  }

  public function index(){
    if ($this->session->userdata('logged_in') == true) {
      if ($this->session->userdata('usr_access_level') == 1) {
        redirect('users');
      } else {
        redirect('me');
    }
  } else {
    // Set validation rules for view filters
    $this->form_validation->set_rules('usr_email', 'User Email', 'required|valid_email');
    $this->form_validation->set_rules('usr_password', 'User Password', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header');
      $this->load->view('users/signin');
      $this->load->view('templates/footer');
    } else {
      # code...
    }


  }
}

 ?>

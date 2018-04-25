<?php

class Users extends MY_Controller{
  function __construct(){
    parent::__construct();
    $this->load->helper('file');
    $this->load->model('Users_model');
    $this->load->helper('Password_model');

    if (($this->session->userdata('loggedin') == false) || ($this->session->userdata('usr_access_level') != 1)) {
      redirect('signin');
    }
  }
}

 ?>

<?php

/**
 * me controller is used by users who are not admins, ie
 * users.usr_access_level is set to 2
 */
class Me extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->model('Users_model');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');

    if (($this->session->userdata('logged_in') == false) || (!$this->session->userdata('usr_access_level') >= 2)) {
      redirect('signin/signout');
    }

  }

  public function index(){
    // Set validation rules
    $this->form_validation->set_rules('usr_fname', 'User First Name', 'required');
    $this->form_validation->set_rules('usr_lname', 'User Last Name', 'required');
    $this->form_validation->set_rules('usr_uname', 'Username', 'required');
    $this->form_validation->set_rules('usr_email', 'User Email', 'required|valid_email');
    $this->form_validation->set_rules('usr_confirm_email', 'Email Confirmation', 'required|valid_email');
    $this->form_validation->set_rules('usr_add1', 'User Address Line 1', 'required');
    $this->form_validation->set_rules('usr_add2', 'User Address Line 2', 'required');
    $this->form_validation->set_rules('usr_add3', 'User Address Line 3', 'required');
    $this->form_validation->set_rules('usr_town_city', 'User Town/City', 'required');
    $this->form_validation->set_rules('usr_zip_pcode', 'User Post Code', 'required');

    $data['id'] = $this->session->userdata('usr_id');

    $data['page_heading'] = "Edit my details";

    if ($this->form_validation->run() == false) {
      // Prepopulate form for existing users
      $query = $this->Users_model->get_user_details($data['id']);
      foreach ($query->result() as $row) {
        $usr_fname = $row->usr_fname;
        $usr_lname = $row->usr_lname;
        $usr_uname = $row->usr_uname;
        $usr_email = $row->usr_email;
        $usr_add1 = $row->usr_add1;
        $usr_add2 = $row->usr_add2;
        $usr_add3 = $row->usr_add3;
        $usr_town_city = $row->usr_town_city;
        $usr_zip_pcode = $row->usr_zip_pcode;
      }
    } else {
      # code...
    }

  }
}


 ?>

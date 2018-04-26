<?php

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->model('Users_model');
        $this->load->helper('Password_model');

        if (($this->session->userdata('loggedin') == false) || ($this->session->userdata('usr_access_level') != 1)) {
            redirect('signin');
        }
    }

    public function index()
    {
        $data['page_heading'] = 'Viewing users';
        $data['query'] = $this->Users_model->get_all_users();
        $this->load->view('templates/header');
        $this->load->view('users/view_all_users', $data);
        $this->load->view('templates/footer');
    }

    // Handles the creation of new users
    public function new_user()
    {
        // Set validation rules
        $this->form_validation->set_rules('usr_fname', 'First Name', 'required');
        $this->form_validation->set_rules('usr_lname', 'Last Name', 'required');
        $this->form_validation->set_rules('usr_uname', 'Username', 'required');
        $this->form_validation->set_rules('usr_email', 'Email', 'required|valid_email|is_unique[users.usr_email]');
        $this->form_validation->set_rules('usr_confirm_email', 'Confirm Email', 'required|valid_email|matches[usr_email]');
        $this->form_validation->set_rules('usr_add1', 'Address Line 1', 'required');
        $this->form_validation->set_rules('usr_add2', 'Address Line 2', 'required');
        $this->form_validation->set_rules('usr_add3', 'Address Line 3', 'required');
        $this->form_validation->set_rules('usr_town_city', 'Town/City', 'required');
        $this->form_validation->set_rules('usr_zip_pcode', 'Post Code', 'required');
        $this->form_validation->set_rules('usr_access_level', 'User Access Level', 'min_length[1]|max_length[125]');
        $this->form_validation->set_rules('usr_is_active', 'User is active?', 'required');
        $data['page_heading'] = 'New user';

        if ($this->form_validation->run() == false) {
            $data['usr_fname'] = array(
                                  'name' => 'usr_fname',
                                  'class' => 'form-control',
                                  'id' => 'usr_fname',
                                  'value' => set_value('usr_fname', ''),
                                  'maxlength' => '100',
                                  'size' => '35'
                                  );
            $data['usr_lname'] = array(
                                  'name' => 'usr_lname',
                                  'class' => 'form-control',
                                  'id' => 'usr_lname',
                                  'value' => set_value('usr_lname', ''),
                                  'maxlength' => '100',
                                  'size' => '35'
                                  );
            $data['usr_uname'] = array(
                                'name' => 'usr_uname',
                                'class' => 'form-control',
                                'id' => 'usr_uname',
                                'value' => set_value('usr_uname', ''),
                                'maxlength' => '100',
                                'size' => '35'
                              );
            $data['usr_email'] = array('name' => 'usr_email',
                               'class' => 'form-control',
                               'id' => 'usr_email',
                               'value' => set_value('usr_email', ''),
                               'maxlength' => '100',
                               'size' => '35'
                             );
            $data['usr_confirm_email'] = array(
                              'name' => 'usr_confirm_email',
                              'class' => 'form-control',
                              'id' => 'usr_confirm_email',
                              'value' => set_value('usr_confirm_email',''),
                              'maxlength' => '100',
                              'size' => '35'
                            );
            $data['usr_add1'] = array(
                              'name' => 'usr_add1',
                              'class' => 'form-control',
                              'id' => 'usr_add1',
                              'value' => set_value('usr_add1', ''),
                              'maxlength' => '100',
                              'size' => '35'
                            );
            $data['usr_add2'] = array('name' => 'usr_add2', 'class' =>
'form-control', 'id' => 'usr_add2', 'value' =>
set_value('usr_add2', ''), 'maxlength' => '100', 'size' =>
'35');
            $data['usr_add3'] = array('name' => 'usr_add3', 'class' =>
'form-control', 'id' => 'usr_add3', 'value' =>
set_value('usr_add3', ''), 'maxlength' => '100', 'size' =>
'35');
            $data['usr_town_city'] = array('name' => 'usr_town_city',
'class' => 'form-control', 'id' => 'usr_town_city', 'value' =>
set_value('usr_town_city', ''), 'maxlength' => '100', 'size'
=> '35');
            $data['usr_zip_pcode'] = array('name' => 'usr_zip_pcode',
'class' => 'form-control', 'id' => 'usr_zip_pcode', 'value' =>
set_value('usr_zip_pcode', ''), 'maxlength' => '100', 'size'
=> '35');
            $data['usr_access_level'] = array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5);
            $this->load->view('templates/header', $data);
            $this->load->view('users/new_user', $data);
            $this->load->view('templates/footer', $data);
        } else {
            # code...
        }
    }
}

<?php

/**
 * me controller is used by users who are not admins, ie
 * users.usr_access_level is set to 2
 */
class Me extends CI_Controller
{
    public function __construct()
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

    public function index()
    {
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

            $data['usr_fname'] = array(
              'name' => 'usr_fname',
              'class' => 'form-control',
              'id' => 'usr_fname',
              'value' => set_value('usr_fname', $usr_fname),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_lname'] = array(
              'name' => 'usr_lname',
              'class' => 'form-control',
              'id' => 'usr_lname',
              'value' => set_value('usr_lname', $usr_lname),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_uname'] = array(
              'name' => 'usr_uname',
              'class' => 'form-control',
              'id' => 'usr_uname',
              'value' => set_value('usr_uname', $usr_uname),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_email'] = array(
              'name' => 'usr_email',
              'class' => 'form-control',
              'id' => 'usr_email',
              'value' => set_value('usr_email', $usr_email),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_confirm_email'] = array(
              'name' => 'usr_confirm_email',
              'class' => 'form-control',
              'id' => 'usr_confirm_email',
              'value' => set_value('usr_confirm_email', $usr_email),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_add1'] = array(
              'name' => 'usr_add1',
              'class' => 'form-control',
              'id' => 'usr_add1',
              'value' => set_value('usr_add1', $usr_add1),
              'maxlength' => '100',
              'size' => '35'
            );

            $data['usr_add2'] = array(
              'name' => 'usr_add2',
              'class' => 'form-control',
              'id' => 'usr_add2',
              'value' => set_value('usr_add2', $usr_add2),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_add3'] = array(
              'name' => 'usr_add3',
              'class' => 'form-control',
              'id' => 'usr_add3',
              'value' => set_value('usr_add3', $usr_add3),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_town_city'] = array(
              'name' => 'usr_town_city',
              'class' => 'form-control',
              'id' => 'usr_town_city',
              'value' => set_value('usr_town_city', $usr_town_city),
              'maxlength' => '100',
              'size' => '35'
            );
            $data['usr_zip_pcode'] = array(
              'name' => 'usr_zip_pcode',
              'class' => 'form-control',
              'id' => 'usr_zip_pcode',
              'value' => set_value('usr_zip_pcode', $usr_zip_pcode),
              'maxlength' => '100',
              'size' => '35'
            );

            $this->load->view('templates/header', $data);
            $this->load->view('users/me', $data);
            $this->load->view('templates/footer', $data);

        } else { // validation passed, now escape the data
          $data = array(
            'usr_fname' => $this->input->post('usr_fname'),
            'usr_lname' => $this->input->post('usr_lname'),
            'usr_uname' => $this->input->post('usr_uname'),
            'usr_email' => $this->input->post('usr_email'),
            'usr_add1' => $this->input->post('usr_add1'),
            'usr_add2' => $this->input->post('usr_add2'),
            'usr_add3' => $this->input->post('usr_add3'),
            'usr_town_city' => $this->input->post('usr_town_city'),
            'usr_zip_pcode' => $this->input->post('usr_zip_pcode')
          );

          $id = $this->session->userdata('usr_id');


          if ($this->Users_model->process_update_user($id, $data)) {
            redirect('users');
          }

        }
    }

    public function change_password(){
      $this->form_validation->set_rules('usr_new_pw_1', 'New Password', 'required');
      $this->form_validation->set_rules('usr_new_pw_2', 'Confirm Password', 'required');

      if ($this->form_validation->run() == false) {
        $data['usr_new_pw_1'] = array(
          'name' => 'usr_new_pw_1',
          'class' => 'form-control',
          'type' => 'password',
          'id' => 'usr_new_pw_1',
          'value' => set_value('usr_new_pw_1', ''),
          'maxlength' => '100',
          'size' => '35',
          'placeholder' => 'Type your new password here...'
        );
        $data['usr_new_pw_2'] = array(
          'name' => 'usr_new_pw_2',
          'class' => 'form-control',
          'type' => 'password',
          'id' => 'usr_new_pw_2',
          'value' => set_value('usr_new_pw_2', ''),
          'maxlength' => '100',
          'size' => '35',
          'placeholder' => 'Confirm your new password here...'
        );
        $data['submit_path'] = 'me/change_password';

        $this->load->view('templates/header', $data);
        $this->load->view('users/change_password', $data);
        $this->load->view('templates/footer', $data);
      } else {
        $hash = $this->input->post('usr_new_pw_1');
        $data = array(
          'usr_hash' => $hash,
          'usr_id' => $this->session->userdata('usr_id')
        );
        if ($this->Users_model->update_user_password($data)) {
          redirect('signin/signout');
        }
      }

    }
}

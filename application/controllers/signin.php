<?php

class Signin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
    }

    public function index()
    {
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
            } else { // Validation passed
                $usr_email = $this->input->post('usr_email');
                $password = $this->input->post('usr_password');

                $this->load->model('Signin_model');
                $query = $this->Signin_model->does_user_exist($usr_email);
                if ($query->num_rows() == 1) {// One matching row found
                    foreach ($query->result() as $row) {
                        $hash = $password;
                        if ($row->usr_is_active != 0) {
                            if ($hash != $row->usr_hash) {
                                $data['login_fail'] = true;
                                $this->load->view('templates/header');
                                $this->load->view('users/signin', $data);
                                $this->load->view('templates/footer');
                            } else {
                                $data = array(
                                           'usr_id' => $row->usr_id,
                                           'acc_id' => $row->acc_id,
                                           'usr_email' => $row->usr_email,
                                           'usr_access_level' => $row->usr_access_level,
                                           'logged_in' => true
                                     );
                                // Save data to session
                                $this->session->set_userdata($data);
                                if ($data['usr_access_level'] == 2) {
                                    redirect('me');
                                } elseif ($data['usr_access_level'] == 1) {
                                    redirect('users');
                                } else {
                                    redirect('me');
                                }
                            }
                        } else {
                            // User currently Inactive
                            redirect('signin');
                        }
                    }
                }
            }
        }
    }

    public function signout()
    {
        $this->session->sess_destroy();
        redirect('signin');
    }
}

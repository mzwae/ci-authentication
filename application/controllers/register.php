<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->helper('security');
        $this->load->library('encryption');
        $this->load->model('Register_model');
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
    }

    public function index()
    {
        // Set validation rules
        $this->form_validation->set_rules('usr_fname', 'User First Name', 'required');
        $this->form_validation->set_rules('usr_lname', 'User Last Name', 'required');
        $this->form_validation->set_rules('usr_email', 'User Email', 'required|valid_email|is_unique[users.usr_email]');

        // Begin validation
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('users/register');
            $this->load->view('templates/footer');
        } else {
            $password = random_string('alnum', 8);
            $hash = $password;
            $data = array(
              'usr_fname' => $this->input->post('usr_fname'),
              'usr_lname' => $this->input->post('usr_lname'),
              'usr_email' => $this->input->post('usr_email'),
              'usr_is_active' => 1,
              'usr_access_level' => 2,
              'usr_hash' => $hash
            );

            if ($this->Register_model->register_user($data)) {
                $file = read_file('../views/email_scripts/welcome.txt');
                $file = str_replace('%usr_fname%', $data['usr_fname'], $file);
                $file = str_replace('%usr_lname%', $data['usr_lname'], $file);
                $file = str_replace('%password%', $password, $file);
                $email = $data['usr_email'];
                if (mail($email, 'New Password', $file, 'From:me@domain.com')) {
                    redirect('signin');
                }
            } else {
                redirect('register');
            }
        }
    }
}

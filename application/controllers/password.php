<?php
// This controller contains functions that allow the user to request a new password
class Password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="bs-callout bs-callout-error">', '</div>');
    }

    public function index()
    {
        redirect('password/forgot_password');
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('usr_email', 'User Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('users/forgot_password');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('usr_email');
            $num_res = $this->Users_model->count_results($email);
            if ($num_res == 1) {
                $code = $this->Users_model->make_code();
                $data = array(
            'usr_pwd_change_code' => $code,
            'usr_email' => $email
          );
                if ($this->Users_model->update_user_code($data)) {
                    // If updated successfully, send Email
                    $result = $this->Users_model->get_user_details_by_email($email);

                    foreach ($result->result() as $row) {
                        $usr_fname = $row->usr_fname;
                        $usr_lname = $row->usr_lname;
                    }

                    $link = "http://localhost:8080/password/new_password/".$code;
                    $path = 'views/email_scripts/reset_password.txt';
                    $file = read_file($path);
                    $file = str_replace('%usr_fname%', $usr_fname, $file);
                    $file = str_replace('%usr_lname%', $usr_lname, $file);
                    echo $file = str_replace('%link%', $link, $file);

                    if (mail($email, 'Reset your password.', $file, 'From:me@domain.com')) {
                        redirect('signin');
                    } else {
                        // Some sort of error happened, redirect user back to form
                        redirect('password/forgot_password');
                    }
                }
            }
        }
    }

    public function new_password()
    {
        $this->form_validation->set_rules('code', 'Signin new password code', 'required');
        $this->form_validation->set_rules('usr_email', 'User email', 'required');
        $this->form_validation->set_rules('usr_password1', 'User password', 'required');
        $this->form_validation->set_rules('usr_password2', 'Confirmed password', 'required|matches[usr_password1]');

        if ($this->input->post()) {
            $data['code'] = xss_clean($this->input->post('code'));
        } else {
            $data['code'] = xss_clean($this->uri->segment(3));
        }

        if ($this->form_validation->run() == false) {
            $data['usr_email'] = array(
          'name' => 'usr_email',
          'class' => 'form-control',
          'id' => 'usr_email',
          'type' => 'text',
          'value' => set_value('usr_email', ''),
          'maxlength' => '100',
          'size' =>'35',
          'placeholder' => 'Your email'
        );

            $data['usr_password1'] = array(
          'name' => 'usr_password1',
          'class' => 'form-control',
          'id' => 'usr_password1',
          'type' => 'password',
          'value' => set_value('usr_password1', ''),
          'maxlength' => '100',
          'size' => '35',
          'placeholder' => 'Type your password'
        );

            $data['usr_password2'] = array(
          'name' => 'usr_password2',
          'class' => 'form-control',
          'id' => 'usr_password2',
          'type' => 'password',
          'value' => set_value('usr_password2', ''),
          'max-length' => '100',
          'size' => '35',
          'placeholder' => 'Confirm password'
        );

            $this->load->view('templates/header', $data);
            $this->load->view('users/new_password', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // Does code from input match the code against the email_scripts
            $email = xss_clean($this->input->post('usr_email'));

            if (!$this->Users_model->does_code_match($data, $email)) {
                //Code doesn't match
                redirect('users/forgot_password');
            } else { //Code match
                $hash = $this->input->post('usr_password1');
                $data = array(
                  'usr_hash' => $hash,
                  'usr_email' => $email
                );

                if ($this->Users_model->update_user_password($data)) {
                    // Send confirmation email to the user
                    $link = 'http://localhost:8080/signin';
                    $result = $this->Users_model->get_user_details_by_email($email);

                    foreach ($result->result() as $row) {
                        $usr_fname = $row->usr_fname;
                        $usr_lname = $row->usr_lname;
                    }

                    $path = '/application/views/email_scripts/new_password.txt';
                    $file = read_file($path);
                    $file = str_replace('%usr_fname%', $usr_fname, $file);
                    $file = str_replace('%usr_lname%', $usr_lname, $file);
                    $file = str_replace('%password%', $password, $file);
                    $file = str_replace('%link%', $link, $file);
                    if (mail($email, 'New Password', $file, 'From:me@domain.com')) {
                        redirect('signin');
                    }
                }
            }
        }
    }
}

<?php

class Signin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function does_user_exist($email)
    {
        $this->db->where('usr_email', $email);
        $query = $this->db->get('users');
        return $query;
    }
}

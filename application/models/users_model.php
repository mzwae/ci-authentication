<?php

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_users()
    {
        return $this->db->get('users');
    }

    public function process_create_user($data)
    {
        if ($this->db->insert('users', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function process_update_user($id, $data)
    {
        $this->db->where('usr_id', $id);
        if ($his->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_details($id)
    {
        $this->db->where('usr_id', $id);
        $result = $this->db->get('users');

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_user_details_by_email($email)
    {
        $this->db->where('usr_email', $email);
        $result = $this->db->get('users');

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function delete_user($id)
    {
        if ($this->db->delete('users', array('usr_id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function make_code()
    {
        do {
            $url_code = random_string('alnum', 8);

            $this->db->where('usr_pwd_change_code = ', $url_code);
            $this->db->from('users');
            $num = $this->db->count_all_results();
        } while ($num >= 1);

        return $url_code;
    }

    public function count_results($email)
    {
        $this->db->where('usr_email', $email);
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function update_user_password($data)
    {
        $this->db->where('usr_id', $data['usr_id']);
        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function does_code_match($code, $email)
    {
        $query = "SELECT COUNT(*) AS count
                FROM users
                WHERE usr_pwd_change_code = ?
                AND usr_email = ?";

        $res = $this->db->query($query, array($code, $email));
        foreach ($res->result() as $row) {
            $count = $row->count;
        }

        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function update_user_code($data)
    {
        $this->db->where('usr_email', $data['usr_email']);
        if ($this->db->update('users', $data)) {
            return true;
        } else {
            return false;
        }
    }
}

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

    public function delete_user($id){
      if ($this->db->delete('users', array('usr_id' => $id))) {
        return true;
      } else {
        return false;
      }

    }
}

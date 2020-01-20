<?php

Class Auth_model extends CI_Model
{
    public function cek_user($data)
    {
        return $this->db->get_where('users',$data);
    }
}
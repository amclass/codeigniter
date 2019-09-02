<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function login($auth)
    {
        $sql = "select username,email from users where username='" . $auth['username'] . "' ";
        $sql .= " and password='" . $auth['password'] . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}

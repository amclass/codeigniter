<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board_m extends CI_Model {

	function __construct() {
	    parent::__construct();
	}
  function get_list($table="ci_board"){
    $sql="select * from ".$table." order by board_id desc";
    $query=$this->db->query($sql);
    $result=$query->result();
    return $result;
  }


}

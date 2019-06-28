<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_m extends CI_Model {

	function __construct() {
	    parent::__construct();
	}
	function get_list() {
	    $sql="select * from itmes";
	    $query=$this->db->query($sql);
	    $result=$query->result();
	    return  $result;
	}
	function get_view($id) {
	    $sql="select * from itmes where id=?";
	    $query=$this->db->query($sql,array($id));
	    $result=$query->row();
	    return  $result;
	    
	   
	}
	function insert_todo($content,$created_on,$due_date) {
	    $sql="insert into itmes (content,created_on,due_date) values ('".$content."','".$created_on."','".$due_date."')";
	    $return=$this->db->query($sql);
	    return $return;
	    
	}
	
}

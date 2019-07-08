<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board_m extends CI_Model {

	function __construct() {
	    parent::__construct();
	}
  function get_list($table="ci_board",$type='',$offset='',$limit=''){
		$limit_query='';
		if($limit !='' || $offset != ''){
			$limit_query=" limit ".$offset.",".$limit;
		}


    $sql="select * from ".$table." order by board_id desc ".$limit_query;
    $query=$this->db->query($sql);
		if($type=="count"){
				$result=$query->num_rows();
		}else{
			$result=$query->result();
		}
    return $result;
  }
	function insert_list(){

$data=array();

for($i=0;$i<20;$i++){
	$data_val = array(
			'user_id' => 'admin',
			'subject' => '테스트',
			'contents' => '가나다라마바사',
			'hits' => 1,
			'reg_date' => '2019-07-01',
		);
	array_push($data,$data_val);

}
return $this->db->insert_batch('ci_board', $data);

	}

}

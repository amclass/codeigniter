<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->database();
	    $this->load->model("board_m");
	    $this->load->helper(array("url","date"));
	}
	public function index()
	{
    $this->lists();
	}
  public function lists(){
		//페이지네이션 라이브러리추가
		$this->load->library("pagination");
		//페이징 주소
		$config['base_url']="/codeigniter/board/lists/ci_board/page";
		//전체 게시물
		$config['total_rows']=$this->board_m->get_list($this->uri->segment(3),'count');
		//한 페이지에 표시할 게시물수
		$config['per_page']=5;
		$config['num_links']=5;
		//페이지 번호가 위차한 세그먼트
		$config['uri_segment']=5;
		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이지 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination']=$this->pagination->create_links();

		$page=$this->uri->segment(5,1);
		if($page > 1){
			$start=(($page/$config['per_page']))* $config['per_page'];
		}else{
			$start=($page-1) * $config['per_page'];
		}
		$limit=$config['per_page'];
		$data['list']=$this->board_m->get_list($this->uri->segment(3),'',$start,$limit);
    $this->load->view('board/list_v',$data);
  }

  public function _remap($method){
    $this->load->view("header_v");
    if(method_exists($this, $method)){
      $this->{"{$method}"}();
    }
    $this->load->view("footer_v");
  }

	public function insert(){
    $return_value=$this->board_m->insert_list();
		var_dump($return_value);
  }

	public function view(){
		$idx=$this->uri->segment(3);
		$data['data']=$this->board_m->get_view($idx);
		$this->load->view("board/view",$data);
	}

}

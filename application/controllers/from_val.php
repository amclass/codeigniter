<?php
defined('BASEPATH') or exit('No direct script access allowed');

class From_val extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
  }
  public function index(){
    $this->forms();
  }

  public function _remap($method){
    $this->load->view("header_v");
    if(method_exists($this, $method)){
      $this->{"{$method}"}();
    }
    $this->load->view("footer_v");
  }
  /*폼 검증 테스트*/
  public function forms(){
    //폼 검증 라이브러리 로드
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username','아이디','required|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('password','비밀번호','required|matches[passconf]');
    $this->form_validation->set_rules('passconf','비밀번호 확인','required');
    $this->form_validation->set_rules('email','이메일','required|valid_email');
    if($this->form_validation->run() == false){
      $this->load->view("from/view_v");
    }else{
      $this->load->view("from/success_v");
    }
  }
}

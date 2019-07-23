<?php
defined('BASEPATH') or exit('No direct script access allowed');

class From_val extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->forms();
    }

    public function _remap($method)
    {
        $this->load->view("header_v");
        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        $this->load->view("footer_v");
    }

    /* 폼 검증 테스트 */
    public function forms()
    {
        // 폼 검증 라이브러리 로드
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', '아이디', 'callback_username_check');
        $this->form_validation->set_rules('password', '비밀번호', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', '비밀번호 확인', 'required');
        $this->form_validation->set_rules('email', '이메일', 'required|valid_email');

        $this->form_validation->set_rules('count', '기본값', 'numeric');
        $this->form_validation->set_rules('myselect', '셀렉트값', '');
        $this->form_validation->set_rules('mycheck[]', '체크박스', '');
        $this->form_validation->set_rules('myradio', '라디오버튼', '');

        if ($this->form_validation->run() == false) {
            $this->load->view("from/view_v");
        } else {
            $this->load->view("from/success_v");
        }
    }

    function username_check($id)
    {
        $this->load->database();
        if ($id) {
            $result = array();
            $sql = "select * from users where username='" . $id . "'";
            $query = $this->db->query($sql);
            $result = $query->row();
            if ($result) {
                $this->form_validation->set_message("username_check", $id . "은 중복된 아이디 입니다.");
                return false;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message("username_check", "아이디를 입력해주세요.");
            return False;
        }
    }
}

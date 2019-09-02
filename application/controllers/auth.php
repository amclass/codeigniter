<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("auth_m");
        $this->load->helper("form");
    }

    public function index()
    {
        $this->login();
    }

    public function _remap($method)
    {
        $this->load->view("header_v");
        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        $this->load->view("footer_v");
        session_write_close();
    }

    public function login()
    {
        // 폼 검증 라이브러리
        $this->load->library("form_validation");

        $this->load->helper('alert');
        // 폼 검증할 필드와 규칙 사전정의
        $this->form_validation->set_rules('username', '아이디', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', '비밀번호', 'required');
        echo "<meta http-equiv='Content-type' content='text/xml' charset='utf-8'/>";

        if ($this->form_validation->run() == true) {
            $auth_data = array(
                'username' => $this->input->post('username', true),
                'password' => $this->input->post('password', true)
            );
            $result = $this->auth_m->login($auth_data);
            if ($result) {
                // 세션생성
                $newdata = array(
                    'username' => $result->username,
                    'email' => $result->email,
                    'logged_in' => true
                );

                $this->session->set_userdata($newdata);
                alert('로그인이 되었습니다.', '/codeigniter/board/lists/ci_board/page1');
            } else {
                // 실패시
                alert('아이디나 패스워드를 입력해주세요.', '/codeigniter/board/lists/ci_board/page1');
            }
        } else {
            $this->load->view('auth/login_v');
        }
    }

    public function logout()
    {
        $this->load->helper("alert");
        $this->session->sess_destroy();
        echo "<meta http-equiv='Content-type' content='text/xml' charset='utf-8'/>";
        alert("로그아웃되었습니다.", '/codeigniter/board/lists/ci_board/page/1');
        exit();
    }
}

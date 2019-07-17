<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Board extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("board_m");
        $this->load->helper(array(
            "url",
            "date"
        ));
    }

    public function index()
    {
        $this->lists();
    }

    public function lists()
    {
        $this->output->enable_profiler(TRUE);
        // 검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 5;
        // 주소중에 q 세그먼트가 있는지 검사하기 위해 주소를 배열로 반환
        $uri_arr = $this->segment_explode($this->uri->uri_string());
        if (in_array('q', $uri_arr)) {
            // 주소에 검색어가 있을 경우 처리
            $search_word = urldecode($this->url_explode($uri_arr, 'q'));
            // 페이지네이션용 주소
            $page_url = '/q/' . $search_word;
            $uri_segment = 7;
        }
        // 페이지네이션 라이브러리추가
        $this->load->library("pagination");
        // 페이징 주소
        $config['base_url'] = "/codeigniter/board/lists/ci_board/" . $page_url . "/page/";
        // 전체 게시물
        $config['total_rows'] = $this->board_m->get_list($this->uri->segment(3), 'count', '', '', $search_word);
        // 한 페이지에 표시할 게시물수
        $config['per_page'] = 5;
        // 선택된 페이지 번호 자우로 몇개의 숫자 링크 설정
        $config['num_links'] = 5;
        // 페이지 번호가 위차한 세그먼트
        $config['uri_segment'] = $uri_segment;
        // 페이지네이션 초기화
        $this->pagination->initialize($config);
        // 페이지 링크를 생성하여 view에서 사용할 변수에 할당
        $data['pagination'] = $this->pagination->create_links();
        $page = $this->uri->segment($uri_segment, 1);
        if ($page > 1) {
            $start = (($page / $config['per_page'])) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }
        $limit = $config['per_page'];
        $data['list'] = $this->board_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
        $this->load->view('board/list_v', $data);
    }

    /*
     * url중 키값을 구분하여 값을 가져오도록
     * @param Array $url : segment_explode 한 url 값
     * @param String $key : 가져오려는 값의 key
     * @return String $url[$k] : 리턴값
     */
    function url_explode($url, $key)
    {
        $cnt = count($url);
        for ($i = 0; $cnt > $i; $i ++) {
            if ($url[$i] == $key) {
                $k = $i + 1;
                if (array_key_exists($k, $url)) {
                    return $url[$k];
                } else {
                    return "";
                }
            }
        }
    }

    /*
     * HTTP url을 /를 Delimiter 로 사용하여 배열로 바꿔 리턴한다.
     * @param String 대상이 되는 문자열
     * return String[]
     */
    function segment_explode($seg)
    {
        // 세그먼트 앞뒤 / 제거 후 uri를 배열로 반환
        $len = strlen($seg);
        if (substr($seg, 0, 1) == "/") {
            $seg = substr($seg, 1, $len);
        }
        $len = strlen($seg);
        if (substr($seg, - 1) == "/") {
            $seg = substr($seg, 0, $len - 1);
        }
        $seg_exp = explode("/", $seg);
        return $seg_exp;
    }

    public function _remap($method)
    {
        $this->load->view("header_v");
        if (method_exists($this, $method)) {
            $this->{"{$method}"}();
        }
        $this->load->view("footer_v");
    }

    public function insert()
    {
        $return_value = $this->board_m->insert_list();
    }

    public function view()
    {
        $idx = $this->uri->segment(5);
        $table = $this->uri->segment(3);
        $data['data'] = $this->board_m->get_view($table, $idx);

        $this->load->view("board/view_v", $data);
    }

    public function write()
    {
        echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8' />";
        // 글쓰기 성공시
        if ($_POST) {
            // 경고창 헬퍼 로딩
            $this->load->helper('alert');
            // 주소 중에서 page세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
            $uri_array = $this->segment_explode($this->uri->uri_string());

            if (in_array('page', $uri_array)) {
                $pages = urldecode($this->url_explode($uri_array, 'page'));
            } else {
                $pages = 1;
            }
            if (! $this->input->post('subject', true) && ! $this->input->post('contents', true)) {
                alert("비정상적인 접근입니다.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $pages);
                exit();
            }
            $write_data = array(
                'subject' => $this->input->post('subject', true),
                'contents' => $this->input->post('contents', true),
                'table' => $this->uri->segment(3)
            );
            $result = $this->board_m->insert_board($write_data);

            if ($result) {
                // 글 작성 성공시 게시물 목록으로
                alert("입력되었습니다.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $pages);
                exit();
            } else {
                alert("다시 입력해주세요.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $pages);
                exit();
            }
        } else {
            $this->load->view("board/write_v");
        }
    }

    function edit()
    {
        echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8' />";
        // 글쓰기 성공시
        if ($_POST) {
            // 경고창 헬퍼 로딩
            $this->load->helper('alert');
            // 주소 중에서 page세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
            $uri_array = $this->segment_explode($this->uri->uri_string());

            if (in_array('page', $uri_array)) {
                $pages = urldecode($this->url_explode($uri_array, 'page'));
            } else {
                $pages = 1;
            }
            if (! $this->input->post('subject', true) && ! $this->input->post('contents', true)) {
                alert("비정상적인 접근입니다.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $pages);
                exit();
            }
            $write_data = array(
                'subject' => $this->input->post('subject', true),
                'contents' => $this->input->post('contents', true),
                'table' => $this->uri->segment(3),
                'board_id' => $this->uri->segment(5)
            );
            $result = $this->board_m->modify_board($write_data);

            if ($result) {
                // 글 작성 성공시 게시물 목록으로
                alert("입력되었습니다.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $pages);
                exit();
            } else {
                alert("다시 입력해주세요.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $pages);
                exit();
            }
        } else {
            $idx = $this->uri->segment(5);
            $table = $this->uri->segment(3);
            $data['data'] = $this->board_m->get_view($table, $idx);

            $this->load->view("board/modify_v", $data);
        }
    }

    function delete()
    {
        echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8' />";
        $this->load->helper('alert');
        $result = $this->board_m->delete_content($this->uri->segment(3), $this->uri->segment(5));
        if ($result) {
            alert("삭제되었습니다.", "/codeigniter/board/lists/" . $this->uri->segment(3) . "/page/" . $this->uri->segment(7));
            exit();
        } else {
            alert("삭제되었습니다.", "/codeigniter/board/view/" . $this->uri->segment(3) . "/board_id/" . $this->uri->segment(5) . "/page/" . $this->uri->segment(7));
            exit();
        }
    }
}

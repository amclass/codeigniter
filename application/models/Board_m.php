<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Board_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_list($table = "ci_board", $type = '', $offset = '', $limit = '', $search_word = '')
    {
        $sword = '';
        if ($search_word != '') {
            $sword = " where subject like '%" . $search_word . "%' or contents like '%" . $search_word . "%' ";
        }

        $limit_query = '';
        if ($limit != '' || $offset != '') {
            $limit_query = " limit " . $offset . "," . $limit;
        }

        $sql = "select * from " . $table . $sword . " order by board_id desc " . $limit_query;
        $query = $this->db->query($sql);
        if ($type == "count") {
            $result = $query->num_rows();
        } else {
            $result = $query->result();
        }
        return $result;
    }

    function insert_list()
    {
        $data = array();

        for ($i = 0; $i < 20; $i ++) {
            $data_val = array(
                'user_id' => 'admin',
                'subject' => '테스트' . $i,
                'contents' => '가나다라마바사',
                'hits' => 0,
                'reg_date' => '2019-07-01'
            );
            array_push($data, $data_val);
        }
        return $this->db->insert_batch('ci_board', $data);
    }

    function get_view($table, $id)
    {
        $this->db->set('hits', 'hits+1', FALSE);
        $this->db->where('board_id', $id);
        $this->db->update($table);

        $this->db->where("board_id", $id);
        $result = $this->db->get($table)->result_object();
        return $result[0];
    }

    function insert_board($arrays)
    {
        $insert_array = array(
            'board_pid' => 0,
            'user_id' => "admin",
            'user_name' => "관리자",
            'subject' => $arrays['subject'],
            'contents' => $arrays['contents'],
            'reg_date' => date("Y-m-d H:i:s")
        );

        $result = $this->db->insert($arrays['table'], $insert_array);
        return $result;
    }

    function modify_board($arrays)
    {
        $insert_array = array(
            'subject' => $arrays['subject'],
            'contents' => $arrays['contents']
        );

        $where = array(
            "board_id" => $arrays['board_id']
        );

        $result = $this->db->update($arrays['table'], $insert_array, $where);
        return $result;
    }

    function delete_content($table, $board_id)
    {
        $delete_arr = array(
            "board_id" => $board_id
        );
        $result = $this->db->delete($table, $delete_arr);

        return $result;
    }
}

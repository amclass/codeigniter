<!DOCTYPE html>
<html lang=en>

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
   crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>include/js/bootstrap.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>include/css/bootstrap.css">
  <script>
  $(document).ready(function(){
    $("#search_btn").click(function(){
      if($("#q").val() == ''){
        alert("검색어를 입력하세요");
        return false;
      }else{
        var act="/codeigniter/board/lists/ci_board/q/"+$("#q").val()+"/page/1";
        $("#bd_search").attr("action",act).submit();
      }
    });
  });
  function board_search_enter(form){
    var keycode=window.event.keyCode;
    if(keycode==13){$("#search_btn").click();}
  }
  </script>
</head>
<body>
<div id="main">
  <header id="header" data-role="header" data-position="fixed">
    <blockquote>
      <p>만들면서 배우는 CodeIgniter<p>
        <small>실행 예제</small>
    </blockquote>
  </header>
  <nav>
    <ul>
      <li> <a rel="external" href="/board/<?=$this->uri->segment(1)?>/lists/<?=$this->uri->segment(3)?>">게시판 프로젝트</a></li>
    </ul>
  </nav>
